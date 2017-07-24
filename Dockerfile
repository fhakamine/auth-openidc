FROM centos:latest

#Install basic stuff
RUN yum update -y
RUN yum install openssh wget net-tools vim unzip rsync -y
RUN echo 'root:toor' | chpasswd
RUN yum -y install curl openssh-server epel-release && \
    yum -y install pwgen && \
	ssh-keygen -A && \
    sed -i "s/#UsePrivilegeSeparation.*/UsePrivilegeSeparation no/g" /etc/ssh/sshd_config
RUN yum clean all
VOLUME ["/var/log"]
EXPOSE  22
CMD ["/usr/sbin/sshd", "-D"]
RUN yum install -y mod_ssl

#Install apache, php, and mod_auth_openidc
RUN wget https://github.com/pingidentity/mod_auth_openidc/releases/download/v1.8.6/mod_auth_openidc-1.8.6-1.el7.centos.x86_64.rpm
RUN yum -y install httpd php php-devel mod_auth_openidc-1.8.6-1.el7.centos.x86_64.rpm
RUN rm -f mod_auth_openidc-1.8.6-1.el7.centos.x86_64.rpm
RUN yum clean all

#Configure the HTTP Server
ENV OIDCCRYPTOPASSPHRASE='test' OIDCSCRUBREQUESTHEADERS='off' REDIRECTDOMAIN='https://localhost' SCOPES='openid email profile'
ADD httpd-foreground /usr/local/bin/
RUN chmod +x /usr/local/bin/httpd-foreground
RUN rm -rf /etc/httpd/logs
RUN mkdir /etc/httpd/logs
RUN rm -Rf /etc/httpd/conf.d/ssl.conf
ADD auth_openidc.conf /etc/httpd/conf.d/auth_openidc.conf
ADD test.php /usr/share/httpd/test.php
EXPOSE 443 80

CMD ["httpd-foreground"]
