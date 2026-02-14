natas0 = natas0
natas1 = 0nzCigAq7t2iALyvU9xcHlYN4MlkIwlq
natas2 = TguMNxKo1DSa1tujBLuZJnDUlCcUAPlI
natas3 = 3gqisGdR0pjm6tpkDKdIWO2hSvchLeYH
natas4 = QryZXc2e0zahULdHrtHxzyYkj59kUxLQ
![[Pasted image 20260214182156.png]]
natas5 = 0n35PkggAPm2zbEpOU802c0x0Msn1ToK
![[Pasted image 20260214182342.png]]
natas6 = 0RoJwHdSKWFTYR5WuiAewauSuNaBXned
![[Pasted image 20260214183454.png]]
natas7 = bmg8SvU1LizuWjx3y7xkNERkHxGre0GS

Hint : /etc/natas_webpass/natas8 
![[Pasted image 20260214183728.png]]
natas8 = xcoXLmzMkoIP9D7hlgPlh9XD7OgLAe5Q

$encodedSecret = "3d3d516343746d4d6d6c315669563362";

hex2bin > strrev (reverse) > base64_decode == oubWYf2kBq
![[Pasted image 20260214184357.png]]

natas9 = ZE1ck82lmdGIoErlhQgWND6j2Wzz6b6t
![[Pasted image 20260214185052.png]]

natas10 = t7I5VHvpa14sJTUGV0cbEsbYfFP2dmOu

payload : a /etc/natas_webpass/natas8 
![[Pasted image 20260214194912.png]]

natas11 = UJdqkK1pTu6VLt9UHWAgRZz6sVUZ3lEk

Actual cookie HmYkBwozJw4WNyAAFyB1VUcqOE1JZjUIBis7ABdmbU1GIjEJAyIxTRg%3D

After URL encoding = HmYkBwozJw4WNyAAFyB1VUcqOE1JZjUIBis7ABdmbU1GIjEJAyIxTRg=
```
<!DOCTYPE html>
<html>
<body>

<?php


$defaultdata = array(
    "showpassword" => "no", 
    "bgcolor" => "#ffffff"
);
echo base64_encode(json_encode($defaultdata));
?>

</body>
</html>

```

This gives us a cookie value of : eyJzaG93cGFzc3dvcmQiOiJubyIsImJnY29sb3IiOiIjZmZmZmZmIn0=

### Get the XOR key

