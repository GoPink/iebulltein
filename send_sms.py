#!/usr/bin/python
#-----------------------------------
# Send SMS Text Message
#
# Author : Matt Hawkins
# Site   : http://www.raspberrypi-spy.co.uk/
# Date   : 30/08/2012
#
# Requires account with TxtLocal
# http://www.txtlocal.co.uk/?tlrx=114032
#
#-----------------------------------

# Import required libraries
import urllib      # URL functions
import urllib2     # URL functions
import sys

# Define your message
message =sys.argv[2]+'\n'+sys.argv[3]+'\n'+'indi : '+sys.argv[4]

# Set your username and sender name.
# Sender name must alphanumeric and 
# between 3 and 11 characters in length.
username = 'cherish243@gmail.com'
sender = 'ky'

# Your unique hash is available from the docs page
# https://control.txtlocal.co.uk/docs/
hash = '5a8ec1c462e17859fae4ad3169c2a88d3aeee735'

# Set the phone number you wish to send
# message to.
# The first 2 digits are the country code.
# 44 is the country code for the UK
# Multiple numbers can be specified if required
# e.g. numbers = ('447xxx123456','447xxx654321')
numbers = sys.argv[1]

# Set flag to 1 to simulate sending
# This saves your credits while you are
# testing your code.
# To send real message set this flag to 0
test_flag = 0

#-----------------------------------
# No need to edit anything below this line
#-----------------------------------

values = {'test'    : test_flag,
          'uname'   : username,
          'hash'    : hash,
          'message' : message,
          'from'    : sender,
          'selectednums' : numbers }

url = 'http://www.txtlocal.com/sendsmspost.php'

postdata = urllib.urlencode(values)
req = urllib2.Request(url, postdata)

print 'Attempt to send SMS ...'
try:
  response = urllib2.urlopen(req)
  response_url = response.geturl()
  if response_url==url:
    print 'SMS sent!'
except urllib2.URLError, e:
  print 'Send failed!'
  print e.reason
print(message)
