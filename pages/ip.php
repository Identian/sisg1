<?php
$foo= $_SERVER['HTTP_USER_AGENT'];
if (strpos($foo, 'Chrome') !== false) {
    echo 'Si';
} else { echo 'NO'; }

//https://norfipc.com/codigos/obtener-datos-asociados-direccion-ip-internet.php
//https://www.ipify.org/
$ip2 = file_get_contents('https://api.ipify.org');
    echo "<hr>" . $ip2;
	?>

<script> 
// https://www.c-sharpcorner.com/blogs/getting-client-ip-address-or-local-ip-address-in-javascript
 
 var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;  
if (RTCPeerConnection)(function() {  
    var rtc = new RTCPeerConnection({  
        iceServers: []  
    });  
    if (1 || window.mozRTCPeerConnection) {  
        rtc.createDataChannel('', {  
            reliable: false  
        });  
    };  
    rtc.onicecandidate = function(evt) {  
        if (evt.candidate) grepSDP("a=" + evt.candidate.candidate);  
    };  
    rtc.createOffer(function(offerDesc) {  
        grepSDP(offerDesc.sdp);  
        rtc.setLocalDescription(offerDesc);  
    }, function(e) {  
        console.warn("offer failed", e);  
    });  
    var addrs = Object.create(null);  
    addrs["0.0.0.0"] = false;  
  
    function updateDisplay(newAddr) {  
        if (newAddr in addrs) return;  
        else addrs[newAddr] = true;  
        var displayAddrs = Object.keys(addrs).filter(function(k) {  
            return addrs[k];  
        });  
        //document.getElementById('list').textContent = displayAddrs.join(" or perhaps ") || "n/a";  
	  
	   
	
            var numeroip;
			numeroip=displayAddrs.join(" or perhaps ") || "n/a";
            document.cookie="iplocal="+numeroip+"";
			 
	
	
    }  
  
    function grepSDP(sdp) {  
        var hosts = [];  
        sdp.split('\r\n').forEach(function(line) {  
            if (~line.indexOf("a=candidate")) {  
                var parts = line.split(' '),  
                    addr = parts[4],  
                    type = parts[7];  
                if (type === 'host') updateDisplay(addr);  
            } else if (~line.indexOf("c=")) {  
                var parts = line.split(' '),  
                    addr = parts[2];  
                updateDisplay(addr);  
            }  
        });  
    }  
})();  
else {  
    document.getElementById('list').innerHTML = "No ip";  
   //document.getElementById('list').nextSibling.textContent = "No ip2";  
} 

</script>  
<div id="list"></div>
		
		<?php
		$ip_snrrr=$_COOKIE['iplocal'];
		echo $ip_snrrr;
		?>

<!--
<div id="ip"></div>
<div id="address"></div>
<script>
$.get("https://ipinfo.io", function (response) {
    $("#ip").html(response.ip);
    $("#address").html(response.loc);
}, "jsonp");
</script>
-->
