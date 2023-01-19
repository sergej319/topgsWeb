const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
})

document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}))

const api_key = "317875d9da97449bd31293b89a4d994e"


fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=46.100376&lon=19.667587&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('name-su').innerHTML = data.name
    document.getElementById('country-su').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-su').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-su').innerHTML = "Temperature: " + data.main.temp
});

fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=44.787197&lon=20.457273&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('country-bg').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-bg').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-bg').innerHTML = "Temperature: " + data.main.temp
});

fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=45.267136&lon=19.833549&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('name-ns').innerHTML = data.name
    document.getElementById('country-ns').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-ns').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-ns').innerHTML = "Temperature: " + data.main.temp
});

fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=43.32472&lon=21.90333&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('name-ni').innerHTML = data.name
    document.getElementById('country-ni').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-ni').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-ni').innerHTML = "Temperature: " + data.main.temp
});

fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=45.381561&lon=20.368574&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('name-zr').innerHTML = data.name
    document.getElementById('country-zr').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-zr').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-zr').innerHTML = "Temperature: " + data.main.temp
});

fetch(`https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=44.0127932&lon=20.9114225&units=metric`)           //api for the get request
  .then(response => response.json())
  .then(data => {console.log(data)
    document.getElementById('name-kg').innerHTML = data.name
    document.getElementById('country-kg').innerHTML = "Country: " + data.sys.country
    document.getElementById('humidity-kg').innerHTML = "Humidity: " + data.main.humidity
    document.getElementById('temperature-kg').innerHTML = "Temperature: " + data.main.temp
});





  