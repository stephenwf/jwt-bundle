Creating a key:
```bash
$ openssl genrsa -out hygrid_private.key 2048
```

Extracting public key
```bash
openssl rsa -pubout -in hygrid_private.key -out hygrid_public.key
```
