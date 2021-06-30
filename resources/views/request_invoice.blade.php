
<html>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

           @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');

        </style>
<?php 
$admininfo = 'Hello';
?>
<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">

 <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #5ca203;">
    <thead>
      <tr>
        <th style="text-align:center;" colspan="2"></th>
     </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
	   <tr>
        <td style="border: solid 1px #ddd; padding:30px 20px;" colspan="2">
            <center><i class="far fa-check-circle" style="font-size:40px;color:#5ca203; "></i></center>
			<h2 style="text-align:center; color:#5ca203; text-transform:uppercase;">Invoice</h2>         
        </td>
      </tr>
	  
	  
      <tr>
        <td style="height:35px;"></td>
      </tr>
	  
	        <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
        <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:50%">Name</span> <?php echo $firstname;  ?></p>
		<p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:50%">Email</span> <?php echo $email;  ?></p>
    <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:50%">Order no</span> <?php echo $order_no;  ?></p>
	    </td>
      </tr>
    </tbody>
    <tfooter>
	
      <tr>
	    
      </tr>
    </tfooter>
  </table>
</body>

</html>