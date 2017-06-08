// Haversine formula for calculating distance between two coordinates
// https://en.wikipedia.org/wiki/Haversine_formula
export function toRad(n) {
   return n * Math.PI / 180;
};

export function calculateHaversine(coords){
  
  const lat1 = coords.from.latitude; 
  const lon1 = coords.from.longitude; 
  const lat2 = coords.to.latitude; 
  const lon2 = coords.to.longitude; 

  const R = 3963.19; // km 
  const x1 = lat2-lat1;
  const dLat = toRad(x1);  
  const x2 = lon2-lon1;
  const dLon = toRad(x2);  
  const toNaut = 0.86897583;

  const a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
                  Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
                  Math.sin(dLon/2) * Math.sin(dLon/2);  
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 

  var d = (R * c) * toNaut; 

  return d.toFixed(2);

};