Creating a key:
```bash
$ openssl genrsa -out your_private.key 2048
```

Extracting public key
```bash
openssl rsa -pubout -in your_private.key -out your_public.key
```


Example config
```yaml
hygrid_jwt:
    issuer: https://yourdomain.com
    token_expiry: 60
    signing:
        public_key: 'file://%kernel.root_dir%/ssh/your_public.key'
        private_key: 'file://%kernel.root_dir%/ssh/your_private.key'
```