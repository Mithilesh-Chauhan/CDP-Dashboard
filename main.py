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

if filt is None or filt=="":
	startDate = '2021-04-01'
	endDate = '2021-04-10'
else:
	filters = (json.loads(base64.b64decode(filt)))
	startDate = filters[0]['start_date']
	endDate = filters[0]['end_date']
	channel = filters[0]['channel']

querry = """SELECT
source,
COUNT(DISTINCT td_client_id) as users,COUNT(DISTINCT session_id) as sessions
FROM
msil_gld_prd.pageview
where 
source is not null
and
source!=''
and
channel_id_rec = '"""+channel+"""'
and
DATE_FORMAT(From_unixtime(TIME)+ INTERVAL '330' MINUTE,'%Y-%m-%d')  >= '"""+str(startDate)+"""'
and
DATE_FORMAT(From_unixtime(TIME)+ INTERVAL '330' MINUTE,'%Y-%m-%d')  <= '"""+str(endDate)+"""'
GROUP BY 1
order by 2 desc"""

data = client.query(querry)
# print(query)
# quit()
# data1 = pd.DataFrame.from_dict(data,orient='index',columns=['month','users','sessions'])
df = pd.DataFrame(data['data'],columns=data['columns'])
js = df.to_json(orient = 'records')
print(js)

# print('success')
# print(data1.head(2))
# print("type : ",type(df))
# print(df)

# df.to_json(r'D:\Python\data.json'))