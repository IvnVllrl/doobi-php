maptilersdk.config.apiKey = "AvR1M1nUMgOQSUEpg5Hz";

const map = new maptilersdk.Map({
  container: "map", // container's id or the HTML element in which SDK will render the map
  // style: maptilersdk.MapStyle.OPENSTREETMAP,
  // style: maptilersdk.MapStyle.STREETS.PASTEL,
  style: maptilersdk.MapStyle.OUTDOOR,
  center: [120.58719, 15.16926], // starting position [lng, lat]
  zoom: 13.5, // starting zoom
  // zoom: 17,
});

// MARKER
const angelesTerminal = new maptilersdk.Marker({
  color: "cyan", // Marker Color
  symbol: "marker", // Marker Icon (custom image URL)
})
  .setLngLat([120.59167, 15.15232])
  .addTo(map);

const astroTerminal = new maptilersdk.Marker({
  color: "black", // Marker Color
  symbol: "marker", // Marker Icon (custom image URL)
})
  .setLngLat([120.58719, 15.16926])
  .addTo(map);

// GEOJSON -> DIRECTION
// Dau - Marquee
map.on("load", async function () {
  map.addSource("gps_tracks", {
    type: "geojson",
    data: "Astro_-_Angeles.geojson",
  });

  map.addLayer({
    id: "Marquee",
    type: "line",
    source: "gps_tracks",
    layout: {},
    paint: {
      "line-color": "#e11",
      "line-width": 4,
    },
  });
});
