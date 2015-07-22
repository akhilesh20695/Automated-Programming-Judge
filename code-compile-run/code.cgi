#!/usr/bin/perl
use CGI;
use strict;

#getting code...
my $cgi = new CGI;
my $code = $cgi->param('code');

#making a temp file for the code
#open(CPP, ">code.cpp");
#print CPP $code;
#close(CPP);

#compiling file with output to file
#system("g++ -c code.cpp >& output.txt");

#HTTP headers
print "Content-type: text/html\n";
print "\n";

#printing output file to response header
#open(OUTPUT, "<output.txt");
#while(<OUTPUT>) {
#   print $_ . "<BR>";
#}

print "$code";



