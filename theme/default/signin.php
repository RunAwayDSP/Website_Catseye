<?php
echo '
<form method="POST" action="index.php">
<input type="text" name="username">
<input type="password" name="password">
<input type="hidden" name="auth" value="1">
<button type="submit">Login</button>
</form>
';
?>