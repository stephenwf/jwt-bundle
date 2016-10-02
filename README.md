# JSON WebToken Bundle

Creating a key:
```bash
$ openssl genrsa -out your_private.key 2048
```

Extracting public key
```bash
$ openssl rsa -pubout -in your_private.key -out your_public.key
```


Example config
```yaml
hygrid_jwt:
    issuer: https://yourdomain.com
    token_expiry: 60
    signing:
        public_key: 'file://%kernel.root_dir%/ssh/your_public.key' # only needed for service using tokens.
        private_key: 'file://%kernel.root_dir%/ssh/your_private.key' # only needed for service issuing tokens.
```

Usage:
```php
$issuer = $this->get('hygrid_jwt.issuer');
$token = $issuer->getToken(['testing' => 'awesome']);

// Pass token to back in response
```

Token consumer:
```php
$parser = $this->get('hygrid_jwt.parser');
$token = $parser->parse($token_as_string); // Will throw exception if not valid signature.
```

### Note
Configuration is sparse, use at own risk (or fork).

Built using [https://github.com/lcobucci/jwt](https://github.com/lcobucci/jwt)