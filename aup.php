<?php
/*
Group 04
WEBD3201

Acceptable use policy edited from https://www.cole-and-son.com/en/terms/website-acceptable-use-policy/
*/ 
	$fileName="aup.php";
	$date="01/03/2018";
	$description="acceptable use policy";
	$title="Acceptable Use Policy";
	$banner="Heart Home";
?>

<?php include 'header.php'; ?>
   

<?php 

if(isset($_SESSION['disabled_message']))
{
	$disabled_message =  $_SESSION['disabled_message'];

		session_unset($_SESSION['disabled_message']);
    	session_destroy(); 

		unset($_SESSION['disabled_message']);

}
else
{
	$disabled_message = "";
}

?>


    
	<p class = "introduction">

		<?php echo $disabled_message; ?>
	
		<h3>Heart Home Acceptable Use Policy</h3><br/>

		This acceptable use policy sets out the terms between you and us under which you may access our website <a href="http://opentech2.durhamcollege.org/webd3201/group04/">Heart Home</a>. Heart Home is operated by Michael Griffith and Zedd Whitaker ("we", "us", or "our"). This acceptable use policy applies to all users of, and visitors to, our site.

		<br/>Your use of our site means that you accept, and agree to abide by, all the policies in this acceptable use policy.

		<h4>Prohibited Uses</h4>
		You may use our site only for lawful purposes. You may not use our site:
		<ul>
			<li>In any way that breaches any applicable local, national or international law or regulation;</li>
			<li>In any way that is unlawful or fraudulent, or has any unlawful or fraudulent purpose or effect;</li>
			<li>For the purpose of harming or attempting to harm minors in any way;</li>
			<li>To transmit any unsolicited or unauthorised advertising or promotional material or any other form of similar solicitation (spam);</li>
			<li>To knowingly transmit any data, send or upload any material that contains viruses, Trojan horses, worms, time-bombs, keystroke loggers, spyware, adware or any other harmful programs or similar computer code designed to adversely affect the operation of any computer software or hardware.</li>
		</ul>

		You also agree:
		<ul>
			<li>Not to reproduce, duplicate, copy or re-sell any part of our site in contravention of the provisions of our terms of website use;</li>
			<li>Not to access without authority, interfere with, damage or disrupt:
			<br/><ul>
				<li>any part of our site;</li>
				<li>any equipment or network on which our site is stored;</li>
				<li>any software used in the provision of our site; or</li>
				<li>any equipment or network or software owned or used by any third party.</li>
			</ul>
			</li>
		</ul>
		
		<h4>Suspension and Termination</h4>
		We will determine, in our discretion, whether there has been a breach of this acceptable use policy through your use of our site.  When a breach of this policy has occurred, we may take such action as we deem appropriate.<br/>
		Failure to comply with this acceptable use policy constitutes a material breach of the terms of use upon which you are permitted to use our site, and may result in our taking all or any of the following actions:
		<ul>
			<li>Immediate, temporary or permanent withdrawal of your right to use our site;</li>
			<li>Immediate, temporary or permanent removal of any posting or material uploaded by you to our site;</li>
			<li>Issue of a warning to you;</li>
			<li>Legal proceedings against you for reimbursement of all costs on an indemnity basis (including, but not limited to, reasonable administrative and legal costs) resulting from the breach;</li>
			<li>Further legal action against you;</li>
			<li>Disclosure of such information to law enforcement authorities as we reasonably feel is necessary.</li>
		</ul>
		We exclude liability for actions taken in response to breaches of this acceptable use policy.  The responses described in this policy are not limited, and we may take any other action we reasonably deem appropriate.

		<h4>Changes to Acceptable Use Policy</h4>
		We may revise this acceptable use policy at any time by amending this page. You are expected to check this page from time to time to take notice of any changes we make, as they are legally binding on you. Some of the provisions contained in this acceptable use policy may also be superseded by provisions or notices published elsewhere on our site.


	</p>




<?php include 'footer.php'; ?>