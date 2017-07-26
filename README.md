
## About this image

This is a sample docker container used to test OpenID Connect and OAuth2.

## How to run on your local Docker (example)

```
docker pull fhakamine/auth-openidc
sudo docker run -d --name openidc -p 80:80 -p 443:443 \
-e OIDCPROVIDERMETADATAURL='https://ice.okta.com/.well-known/openid-configuration' \
-e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' \
-e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' fhakamine/auth-openidc
```

## How to run on Docker Cloud 

**Important:** Requires you to configure Docker Cloud and link your PaaS account first: https://docs.docker.com/docker-cloud/getting-started/

[![Deploy to Docker Cloud](https://files.cloud.docker.com/images/deploy-to-dockercloud.svg)](https://cloud.docker.com/stack/deploy/?repo=https%3A%2F%2Fgithub.com%2Ffhakamine%2Fauth-openidc%2Ftree%2Fmaster)

## Parameters

- `OIDCPROVIDERMETADATAURL`: Your authorization server URL. For example: https://ice.okta.com/.well-known/openid-configuration
- `OIDCCLIENTID`: Client ID that identifies your HTTP server.
- `OIDCCLIENTSECRET`: Client secret for your HTTP server.
- `OIDCScope`: Scopes/claims you want to request in the OAuth flow.
- `OIDCCRYPTOPASSPHRASE` and `OIDCSCRUBREQUESTHEADERS` (optionals): Secret and flag for encrypting the state token and the request headers.
- `REV_PROXY`:  The server you set will be reverse proxied under "/rev". For example, if you set REV_PROXY=https://my.intranet.com, https://localhost/rev/appX will go to https://my.intranet.com/appX


## Specs

- The container runs Apache 2 with PHP, SSL (self-signed certificates), and mod_auth_openidc.
- Container runs as https://localhost. 
- OAuth uses the authorization code flow.
- The default redirect_uri is https://localhost/redirect_uri
- The HTTP server provides 3 main paths: /test.php for tests, /reqbin/ to test requestb.in, and /rev/ to test as reverse proxy.
- You can always work on your Docker/Apache-fu to customize the default behavior.

## How to run with Okta SSO:

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/.well-known/openid-configuration' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' fhakamine/auth-openidc
```

## How to run with Okta API AM:

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/oauth2/abcd1234/.well-known/openid-configuration' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' fhakamine/auth-openidc
```

## How to run with Okta API AM and custom scopes

```
sudo docker run -d --name openidc -p 80:80 -p 443:443 -e OIDCPROVIDERMETADATAURL='https://ice.okta.com/oauth2/abcd1234/.well-known/oauth-authorization-server' -e OIDCCLIENTID='client_id' -e OIDCCLIENTSECRET='client_secret' -e REDIRECTDOMAIN='https://localhost' -e REV_PROXY='https://www.google.com' -e SCOPES='openid profile email promos:read' fhakamine/auth-openidc
```

## How to test

### Requestbin

1. Go to https://requestb.in/
2. Get your id (https://requestb.in/<ID>)
3. Call https://localhost/reqbin/<ID>
4. Return to requesb.in and check your results

### PHP

1. Go to https://localhost/test.php
2. Check your results

## How to customize your own container

```
docker build -t my-oidc .
```

## Support

This container is provided “AS IS” with no express or implied warranty for accuracy or accessibility. This container intended to demonstrate the basic integration between HTTP servers with OIDC and does not represent, by any means, the recommended approach or is intended to be used in development or productions environments.
