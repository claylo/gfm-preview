<?php
/**
 * This file is part of GitHub Flavored Markdown Preview.tmbundle
 *
 * @copyright 2012 Clay Loveless <clay@php.net>
 * @license   http://claylo.mit-license.org/2012/ MIT License
 */
$doc = file_get_contents("php://stdin");
$req = json_encode(array("text" => $doc, "mode" => "gfm"));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/markdown");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "User-Agent: TextMate-1.5"));
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$gfm = curl_exec($ch);
curl_close($ch);

$stylesheet = file_get_contents(__DIR__.'/../support/style.css');

$output = <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<title>Preview: GitHub Flavored Markdown</title>
<style type="text/css" media="screen">
{$stylesheet}
</style>
</head>
<body>
<div id="header-wrapper">
    <div id="header">
        <a class="logo" href="http://github.github.com/github-flavored-markdown/"><img width="364" height="41" alt="github flavored markdown" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWwAAAApCAMAAAAmo+PgAAAAYFBMVEX/AAD6AAD/AAD/AADyAAAAAADwAAAAAAD/AAAAAAD/AAD/AAD/AAAAAAD/AAAAAAAAAAAAAAAAAAAAAAD/AAAAAAD/AAAAAAD2AAAAAAAAAAAAAAAAAADvAAD/AAAAAABDsnZCAAAAHXRSTlNws1CP24/ucCBQYDCgsxAgMKDuYEDbgBDHx0CAAA1gwrgAAAd/SURBVHja7ZvplqusEoYzmBhnBRXFgfu/yw+rCohTJzm90+v88F29YoE48FAUpe596g/9mT6A3WrxV41uutFto/5yHrxr31+ba/9F/fICUim523n+p7CVVvdyRHSjdl0dj1pN3zf654uCC3wFNnT9G7A7LflPYYcatddcD9ivqf4e9jB6kd4csP8A9mUcH/0B+w3Y8vewr5rAAdvC3k87iu73sJuxPmC/kY0U6oD9V7ALdcD+LmyplRnWqpCTBMEWvOs6nr2CLX3dLP8N7LQsHxt1JZllmb6GLe19Cin7H5XrLr8NOwMer+WaP8POu6Q1enJhrqwkVldULOBi3WRSv6ARwq4KhWLTRR5l6Y0xoSMWaXi+j8O5pBzcUn2MYwhG6I1aQ2z2lOPYP+DJaCpF58m6h24U6mYcmmtkLpC3Ld5dBQMuW7jnzIC96XLVCeMeXc8ZdNnBFugqWVEp1voZwaZdDPrWCUIEW7ST3qhSBT135gyBEWyJCEkONldL2E6V2IM9E+/7ekTVz443QBWSvcMu0GkcAKY3kobQwr7gMTA8pDMdFt2ponngBaRS06ycbian21Rgg3zTBYJ9S5SawxaVqp4B3ISFHSgjlqPLcwdY2fHEi+mjuG5Y0dVOeMo1bKjfh62Kt2AruQ27Dsvy0iDterxDHXC/Tuw01vjyiC4xjAfABk9OTdbeXHQrvfeK82GYJkFdT/4+GNiF4oCGwbojtEMqxYxnSyk7og13XOTzmK0PEciV3bquUkSE+N+kkLylwbupykQLXeOTTbVKJSrJptkAwE7QZgu2nopAjrWTcgObdR1GiexH2BUZbCdmU2lIIXZcyEMhoqTeOJTOZSOCfTUhYxhjMGwA0pDjFKPTMBrYyvBrwUSHDnonSfxacNEZbB+2ghl4WQdE0GOrrDfYmQDEUAE0ELHzd3RKGr5Mw0Z0CFYFUhLsdQKCE8rGan8fdsuFna18D7YL0bGhF0NgqAkwOW1DsKEMu735whtRPAHcdwPbAGTOpLt3mRYzMXsOWyJkHzao3I2MDdEB1rXmrMyNa0CRXD27faBhMwoouSW7D5tWAAH1O7DdBTgdsZ+NeGONJFOK5Bf4vc5eYUVz2HdoBLrA2a7g4CQbsx1SZ1JS6mBtws7JHSvFltlIjpPDnZpOQwdnjMAntH2ix7R5AobSsGEvYGMBBqjdg+26BMFuDzYVkd8Jwd6Bq2Xnlk8HO8WRoZkxwIid+33Y3bPZLrPqNWxYHAV6lL+E3SEg560SYASIPul93C809yXs1sJ2vN6D3b4DmwJJvgk7LSd5WAxHD2NvPVsvKbQ0DjZYQ20FteN4+hR2LrX8bdgJ3DKGoiXsFnzeitEIJNgi6AWe0ocLbcOms/J/DZsq17AhZUY1tOZF+hddup47f72CPRPALj+DzZkCbcLuMFK4czhsrq0DiA4uJnoM3LuAGc13YFfPMbv6PmzM7UgE9jotkSdcJ89L2PcZ7NMc9qNPP4VdKLUPO9F/FNI3YKsl7AIjtK9/TFDHnx3Y/Dkb4f8UdrAFGxx5CE3RBV8PoL307HmU+dCzsSLJ9mP27TPPxm5W6N7k1Dd124OtxwQFmP4p7Nv2Akm5HRXJCCOiWE/gnc7rMLKCHX4AW2jWPy6QhYvZ2Qo2HbtgyVTuq8I+ssOBO7DdvKrEJ7Apyme7sAWccw3bG2NXNEnc+UrrXDTz1HRYZCMPO1KOb/wB7MCi2IYNOZR5EF9y9cF/582huqiUNH2eeO/CFgWh5iuqzKTWohAr2EQ4wI6sYQvI/Pw17HFepAzvPqZk2kp8wnks8+x4+R1oSN+GTeV92HDfTEBEaJewM9g4fsx5FaPKwiDZDyOsC7KNz2ItmJJD+r6GnZnpIG7qCTbjMuszXkGdWMEmVySuFqqtDCmXI/u8CB4n69rO16/vw3bRgW/CRqSVgP3BAraNMWT7azMD7ruw7cK4hu0r0jbsvrKLq4PthCdewyZcYBDsWU7RaPCpGYLhMYONy2tk7BO69nh6f4G0j8FsGza9AcHeyQU2oQxWkUAje6B4proPm4F/FjxbwxbsZ9hSofZgw6qxmY2cUnht5yJG7Lk47eFbvHjQ22i1LF70YbGuTi/x2Jj2TViW5aU+D+9kI23eC87UHmwI7AUmw0UgpeRda7qe05vAhOY0iRXW5Cr7AXZuiLIimMN+3reGjWcmJQb22q9f5tmIM+wd7fNI8qKNHCQcrWJs37iaX+bZkoghbedrjkhluyx6Kz93NnDfhV0pq1YschDBW6ZaGIUVbPcRJMnlM2w8IevE3mexNJ5w309YJML9k8rY0/vPYb+Z8F3uxPVi+XtYcfVew+4DuL/C34NNh3X2q4xKoEjiCZsiAbYkiZm9DztffoH5UELmm5/0Xhw2fSdLo/5/VBTWdflYnHAKLdH7XwXlRlek2KjLsO3vdaI30F1XMJoth76lk3CxVeJDyKGvwZbLt/39oa/BhpB9wP4Lwftseg0m6DPWoe/BvlEaolBBf+h7sEU1f+Q79D3Y+JSvdSR+34dt//GbYgkX/aH/j/+ad+i3+g+LhD/aO5oJBQAAAABJRU5ErkJggg==" /></a>

    </div>
</div>
<div id="wrapper">
    <article class="markdown-body">
{$gfm}
    </article>
    <div class="credits">
      <p>Thanks to MediaLoot for the free <a href="http://medialoot.com/item/awake-free-web-font/">Awake Sans font</a> used in the logo.</p>
    </div>
</div>
</body>
</html>

EOF;
header('Content-Type: text/html');
echo $output;
