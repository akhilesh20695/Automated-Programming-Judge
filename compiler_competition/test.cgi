#!C:\perl\bin\perl.exe -wT
use strict;
use CGI;

my $query = new CGI;


print $query->header( "text/html" );

print <<END_HERE;
<html>
  <head>
    <title>My First CGI Script</title>
  </head>
  <body bgcolor="#FFFFCC">
    <h1>This is a pretty lame Web page</h1>
    <p>Who is this Ovid guy, anyway?</p>
  </body>
</html>
END_HERE
# must have a line after "END_HERE" or Perl won't recognize
# the token
