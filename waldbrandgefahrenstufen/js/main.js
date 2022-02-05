async function fetchAsync(cityname, apiKey) {
  let response = await fetch(
    "https://wbs-service.niklas-ullmann.de/location/city?name=" + cityname,
    {
      method: "GET",
      headers: {
        "x-api-key": apiKey,
      }
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
