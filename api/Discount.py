import random
from flask import Flask
from flask_cors import CORS

app=Flask(__name__)
CORS(app)
@app.route("/api/<price>",methods=['GET'])

def calculate(price):
    
    if float(price) >= 10000:
        discount = str(float(price)*0.88)
        return discount
    elif float(price) >= 5000:
        discount = str(float(price) * 0.92)
        return discount
    elif float(price) >= 3000:
        discount = str(float(price) * 0.97)
        return discount 
    else:
        discount  = str(float(price))
        return discount 
        
if __name__ == "__main__":
    app.run(debug=True,
    host='0.0.0.0',
    port=1234)
