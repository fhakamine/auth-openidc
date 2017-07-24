## Parameters

```
OIDCProviderMetadataURL ${OIDCPROVIDERMETADATAURL}
OIDCClientID ${OIDCCLIENTID}
OIDCClientSecret ${OIDCCLIENTSECRET}
OIDCCryptoPassphrase ${OIDCCRYPTOPASSPHRASE}
OIDCScrubRequestHeaders ${OIDCSCRUBREQUESTHEADERS}
OIDCRemoteUserClaim email
OIDCScope ${SCOPES}
OIDCRedirectURI ${REDIRECTDOMAIN}/redirect_uri

#REVERSE_PROXY_REQUESTBIN
ProxyPass "/reqbin" "https://requestb.in/"
ProxyPassReverse "/reqbin" "https://requestb.in/"
#REVERSE_PROXY_ANYSERVER
ProxyPass "/rev" ${REV_PROXY}
ProxyPassReverse ${REV_PROXY}
```

## run with default OIDC options

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/.well-known/openid-configuration' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' fhakamine/auth-openidc
```

## run with API AM and OIDC

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/oauth2/abcd1234/.well-known/openid-configuration' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' fhakamine/auth-openidc
```

## run with API AM and custom scopes

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/oauth2/abcd1234/.well-known/oauth-authorization-server' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' -e SCOPES='openid profile email promos:read' fhakamine/auth-openidc
```

## test

### requestbin.

1. Go to https://requestb.in/
2. Get your id (https://requestb.in/<ID>).
3. Call https://localhost/reqbin/<ID>
4. Return to requesb.in and check your results

### php.

1. Go to https://localhost/test.php`
2. Check your results


## build your own
```
docker build -t my-oidc .
```

## bash into
```
docker exec -it openidc bash
```
