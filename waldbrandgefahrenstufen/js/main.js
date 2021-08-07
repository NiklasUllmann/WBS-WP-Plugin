async function fetchAsync(cityname) {
  let response = await fetch(
    "https://wbs-service.niklas-ullmann.de/location/city?name=" + cityname,
    {
      method: "GET",
      credentials: "omit",
    }
  );
  let data = await response;
  if (data.status != "200") {
    throw "Error while loading data";
  } else {
    data = data.json();
    return data;
  }
}
