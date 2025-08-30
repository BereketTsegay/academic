export function updated(rec, dataSet){
    var found =dataSet.findIndex((element) => element.id == rec.id);
    found > -1 ? dataSet[found]=Object.assign({},rec) : dataSet.push(rec);
   return dataSet;
}
export function add(){
  return Object.assign({},{});
}
export function edit(data){
    return Object.assign({},data);
}
export function destroy(data){
    console.log(data);
}
export function view(data){
    console.log(data);
}