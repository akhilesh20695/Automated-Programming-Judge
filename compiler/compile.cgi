#!C:\perl\bin\perl -w
use CGI;

$query = new CGI;

$secretword = $query->param('c');
$remotehost = $query->remote_host();


#open(DATA, ">file.pl")  or die("Couldn't open output file: $!");
open(DATA, "> env/test.java")  or die("Couldn't open output file: $!");

print DATA "$secretword";
close(DATA);

#system("perl file.pl > output.txt");
#system "C:\Program Files\Java\jdk1.7.0_25\bin\javac -cp C:\xampp\cgi-bin test.java";
#system($javaCmd." > test.class");
#system('javac -classpath C:\xampp\cgi-bin test.java');
#systen("C:\\Program Files\\Java\\jdk1.7.0_25\\bin\\java -version > output.txt");
#system('java test > output.txt');
system("javac -g:none -Xlint -d env env/test.java");
system("java -client -classpath env test > output.txt");

open(OUTPUT, "< output.txt");
print $query->header;
#print "<p>The secret word is <b>$secretword</b> and your IP is <b>$remotehost</b>.</p>";
while(<OUTPUT>) {
   print $_;
}
close(OUTPUT);

