export function emailValidation(data){
    const email = new RegExp('([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/')
    return email.test(data);
}
export function required(str){
    if (typeof str === "string" && str.length === 0) {
        return false;
    } 
    // if (typeof str === "object" && str.length === 0) {
    //     return false;
    // } 
    if (str === null || str === undefined) {
        return false
    }
     
      return true;
}
export function inputLengh(str,len){
   if(!required(str)) return false;
   if(str.length!=len) return false;
    return true;
}
export function regexValidation(regx,val){
    if(!regx.test(val)) return false;
     return true;
 }
