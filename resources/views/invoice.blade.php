<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form id="epay-form" name="SendOrder" method="POST" action="{{ $url }}">
		<input type="hidden" name="Signed_Order_B64" value="{{ $signed_order }}">
		<input type="hidden" name="email" size="50" maxlength="50" value="{{ $email }}">
		<input type="hidden" name="Language" value="{{ $lang }}">
		<input type="hidden" name="BackLink" value="{{ $backlink }}">
		<input type="hidden" name="FailureBackLink" value="{{ $fail_backlink }}">
		<input type="hidden" name="PostLink" value="{{ $postlink }}">
		<input type="hidden" name="FailurePostLink" value="{{ $fail_postlink }}">
	</form>
</body>
<script type="text/javascript">
	document.getElementById('epay-form').submit();
</script>
</html>