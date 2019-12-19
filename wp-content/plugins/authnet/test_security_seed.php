<?
function createCheckoutClaim ($valuestosecure, $securityseed) {
        // $valuestosecure may be a subscription_id or a buy it now price
        $len = strlen($securityseed);
        $saltedpass = substr($securityseed, 0, round($len/2)) . $valuestosecure . substr($securityseed, round($len/2), $len);
        return md5($saltedpass);
}

$securityseed = 'LJXJ4AoUl5jIGsyrD5vozExCzpiFSqcMLrRQSl6ccno8ir2lc01QMcMB6yxT3Hgy';
$email = 'leloandy@gmail.com';
echo createCheckoutClaim (substr(md5($email),3,8), $securityseed);
echo substr(md5($email),3,8);
?>