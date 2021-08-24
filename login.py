import os
import pandas as pd
import pytd.pandas_td as pytd
import tdclient
import os,sys
import base64, json

TD_API_KEY = "10453/276d79ee18c5f68f8f49e9645f34f84febd026b4"
TD_API_SERVER = "https://api.treasuredata.com"
con = pytd.connect(apikey=TD_API_KEY, endpoint='https://api.treasuredata.com')
client = pytd.Client(TD_API_KEY,TD_API_SERVER,default_engine='presto')

filt = sys.argv[1]

filters = (json.loads(base64.b64decode(filt)))
username = filters[0]['username']
password = filters[0]['password']

querry = """SELECT
password
from
msil_computed_testdb.pass_auth
where 
username = '"""+username+"""'"""

data = client.query(querry)

password_1 = data['data'][0][0]

if password_1 == password:
	print('success')
else:
	print('fail')