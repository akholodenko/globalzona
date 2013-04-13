#!/usr/local/bin/perl
#
# Program to do the obvious
#
print "Content-type: text/html\n\n";
print 'Hello world.';		# Print a message

$url = 'http://www.perl.com/CPAN/';
print redirect($url);
