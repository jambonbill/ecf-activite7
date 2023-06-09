//

//selectors
const btnBrands=document.getElementById('btnBrands');
const btnInstruments=document.getElementById('btnInstruments');
const btnTypes=document.getElementById('btnTypes');

//render target
const DOMTOM=document.getElementById('DOMTOM');

//attach behavior
btnBrands.addEventListener("click",()=>apifetch("/api/brands"));
btnInstruments.addEventListener("click",()=>apifetch("/api/instruments"));
btnTypes.addEventListener("click",()=>{
    DOMTOM.innerHTML="[not yet implemented]";
});


function apifetch(url)
{
    console.log('apifetch(url)', url);
    
    document.getElementById('DOMTOM').innerHTML='Fetching '+url+"... Please wait";
    //let url="/api/brands";
    fetch(url)
        .then(res=>res.json())
        .then(data=>{
            //console.log(data)
            display(data);
        })
    
}


function display(json)
{
    console.log('display()',json);
    let data=json.data;
    
    let htm='<table class=table>';//(du HTML très simple)
    
    data.forEach(row => {
        console.log(row);        
        
        htm+='<tr>';
        let keys=Object.keys(row);
        for(let key of keys){
            htm+='<td>' + row[key];
        }
        
    });
    
    htm+='</table>';
    
    document.getElementById('DOMTOM').innerHTML=htm;
}

console.log('api.js');