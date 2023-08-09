
export class search{
    constructor(myurlp, mysearchp, ul_add_lip){
        //this.url = myurlp;
        this.url = "https://mail.tecnoweb.org.bo/inf513/grupo11sc/proyecto2/proyectotecno/public";
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
    

    Showlist(data, valor) {
        this.ul_add_li.style.display = "block";
        if (data.estado == 1) {
            this.ul_add_li.innerHTML = "";
            let resultsArray = Object.values(data.result); // Convertir el objeto data.result en un array de arrays

            // Verificar si hay resultados para cada tabla y mostrar los resultados
            resultsArray.forEach((result) => {
                if (result.length > 0) {
                    this.Show_list_each_data(result, valor);
                }
            });

            if (this.ul_add_li.innerHTML === "") {
                this.ul_add_li.innerHTML += `
                    <p style="color:red;"><br>No se encontraron resultados.</p>
                `;
            }
        }
    }

    Show_list_each_data(arrayp, valor, n) {
        for (let item of arrayp) {
            n++;
            let fotoSrc =
                item.foto_user ||
                "https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/svgs/solid/image.svg";
    
            let attributesHTML = ""; // Variable para almacenar los atributos en HTML
    
            // Recorrer todos los atributos del objeto y agregarlos al HTML si coinciden con el valor de búsqueda y no son los campos "password" ni "id"
            for (let key in item) {
                if (
                    item.hasOwnProperty(key) &&
                    key !== "password" && // No agregar el atributo "password"
                    key !== "id" && // No agregar el atributo "id"
                    String(item[key]).toLowerCase().includes(valor.toLowerCase())
                ) {
                    attributesHTML += `<p><strong>${key}: </strong>${item[key]}</p>`;
                }
            }
    
            this.ul_add_li.innerHTML += `
                <li id="${n + this.idli}" value="${item.name}" class="list-group-item" style="">
                    <div class="d-flex flew-row" style="">
                        <div class="p-2 text-center divimg" style="">
                            <img src="${fotoSrc}" class="img-thumbnail" width="50" height="50">
                        </div>
                        <div class="p-2">
                            ${attributesHTML}
                        </div>
                    </div>
                </li>
            `;
    
            // Agregar el evento de clic a cada elemento de la lista
            const listItem = document.getElementById(n + this.idli);
            listItem.addEventListener("click", () => {
                // Verificar si la URL no es null antes de redireccionar
                if (item.url !== null) {
                    // Redireccionar a la URL almacenada en item.url
                    window.location.href = item.url;
                } else {
                    console.log("La URL es null, no se puede redireccionar.");
                }
            });
        }
    }
    
}