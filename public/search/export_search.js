
export class search{
    constructor(myurlp, mysearchp, ul_add_lip){
        this.url = myurlp;
        this.mysearch = mysearchp;
        this.ul_add_li = ul_add_lip;
        this.idli = "mylist";
        this.pcantidad = document.querySelector("#pcantidad");
    }

    InputSearch(){
        this.mysearch.addEventListener("input", (e) => {
            e.preventDefault();
            try{
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                let minimo_letras = 0;
                let valor = this.mysearch.value;
                //console.log(valor);
                if(valor.length > minimo_letras){
                    let datasearch = new FormData();
                    datasearch.append("valor", valor);
                    fetch(this.url, {
                            headers:{
                                "X-CSRF-TOKEN" : token,
                            },
                            method:"post",
                            body:datasearch
                    })
                    .then((data) => data.json())
                    .then((data) => {
                        console.log(data)
                        this.Showlist(data,valor);
                    })
                    .catch(function (error){
                        console.log("Error:", error);
                    });
                }else{
                    this.ul_add_li.style.display = "";
                }
            }catch (error){
                console.log(error);
            }
            
        });
    }

    Showlist(data,valor){
        this.ul_add_li.style.display = "block";
        if(data.estado == 1){
            if(data.result != ""){
                let arrayp = data.result;
                this.ul_add_li.innerHTML = "";
                let n = 0;
                this.Show_list_each_data(arrayp,valor,n);
                let adclasli = document.getElementById('1'+this.idli);
                adclasli(classList.add('selected'));
            }else{
                this.ul_add_li.innerHTML = "";
                this.ul_add_li.innerHTML += `
                    <p style="color:red;"><br>No se encontro</p>
                `;
            }
        }
    }

    Show_list_each_data(arrayp, valor, n) {
        for (let item of arrayp) {
            n++;
            let nombre = item.name;
            let apellido = item.apellido;
            let fotoSrc = item.foto_user || 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/svgs/solid/image.svg';
    
            this.ul_add_li.innerHTML += `
                <li id="${n + this.idli}" value="${nombre}" class="list-group-item" style="">
                    <div class="d-flex flew-row" style="">
                        <div class="p-2 text-center divimg" style="">
                            <img src="${fotoSrc}" class="img-thumbnail" width="50" height="50">
                        </div>
                        <div class="p-2">
                            <strong>${nombre.substr(0, valor.length)}</strong>
                            ${nombre.substr(valor.length)}
                            ${apellido}
                        </div>
                    </div>
                </li>
            `;
    
            // Agregar el evento de clic a cada elemento de la lista
            const listItem = document.getElementById(n + this.idli);
            listItem.addEventListener('click', () => {
                // Redireccionar a la URL almacenada en item.url
                window.location.href = item.url;
            });
        }
    }
    
    
    
    

}