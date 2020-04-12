from flask import render_template
import os
from flask import Flask
app = Flask(__name__)

def covid_map():
    import requests
    import pandas as pd
    from bs4 import BeautifulSoup

    data = requests.get('https://coronavirus-tracker-api.herokuapp.com/v2/locations')

    df = data.json()
    df = pd.DataFrame(df['locations'])

    df['latitude'] = df.coordinates.apply(lambda x: float(x.get('latitude')))
    df['longitude'] = df.coordinates.apply(lambda x: float(x.get('longitude')))
    df['confirmed'] = df.latest.apply(lambda x: x.get('confirmed'))
    df['deaths'] = df.latest.apply(lambda x: x.get('deaths'))
    df['recovered'] = df.latest.apply(lambda x: x.get('recovered'))

    df = df.drop(['coordinates', 'latest'], axis=1)

    df['text'] = df[['country', 'province', 'confirmed', 'deaths']].apply(lambda x: ' - '.join(x.astype(str)), axis=1)

    import folium
    from folium import plugins
    from folium.plugins import HeatMap

    m = folium.Map(location=[18.750, -70.16], zoom_start=1, tiles="cartodbpositron")

    for i in range(0, len(df)):
        folium.Circle(
            location=[df.iloc[i]['latitude'], df.iloc[i]['longitude']],
            popup=df.iloc[i]['text'],
            radius=float(df.iloc[i]['confirmed']) * 10,
            color='crimson',
            fill=True,
            fill_color='crimson'
        ).add_to(m)

    m.save('./app/templates/index.html')
    return "Update reussi"


@app.route("/")
def index():
    return render_template("index.html")

@app.route("/update")
def about():
    ret = covid_map()
    return ret



if __name__ == '__main__':
    app.run()
