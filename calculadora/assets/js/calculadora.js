// VARIABLES INICIALES
const displayValorAnterior = document.getElementById('valor-anterior');
const displayValorActual = document.getElementById('valor-actual');
const botonesNumeros = document.querySelectorAll('.numero');
const botonesOperadores = document.querySelectorAll('.operador');
const api_url = document.getElementById('api_url');

class Display {
    constructor(displayValorAnterior, displayValorActual){
        this.displayValorActual = displayValorActual;
        this.displayValorAnterior = displayValorAnterior;
        this.tipoDeOperacion = undefined;
        this.valorActual = '';
        this.valorAnterior = '';
        this.signos = {
            add:'+',
            divide: '/',
            times: 'x',
            minus:'-',
        }
    }
    agregarNumero(numero) {
        if(numero=='.' && this.valorActual.includes('.')) return
        this.valorActual = this.valorActual.toString() + numero.toString();
        this.imprimirValores();
    }
    borrar(){
        this.valorActual=this.valorActual.toString().slice(0,-1);
        this.imprimirValores();
    }

    borrarTodo(){
        this.valorActual= '';
        this.valorAnterior= '';
        this.tipoDeOperacion= undefined;
        this.imprimirValores();
    }
    operar(tipo){
        
        if ( tipo == 'igual'){

            fetch(`${api_url.value}/${this.tipoDeOperacion}/${this.valorAnterior}/${this.valorActual}`)
            .then((response) => response.json())
            .then((responseJSON) => {


                this.tipoDeOperacion = tipo;
                this.valorAnterior = responseJSON.result;
                this.valorActual = ''; 
                console.log('api2', this)
                this.imprimirValores();
            })
        }
        else{
            
            this.tipoDeOperacion = tipo;
            this.valorAnterior = this.valorActual || this.valorAnterior;
            this.valorActual ='';
            this.imprimirValores();
        }
        
    }
    imprimirValores( ){

        this.displayValorActual.textContent = this.valorActual;
        this.displayValorAnterior.textContent = 
         `${this.valorAnterior} ${this.signos[this.tipoDeOperacion] || ''}`;

    }

}

// INICIALIZAR DISPLAY
const display = new Display(displayValorAnterior, displayValorActual);

// ASIGNAMOS LISTENER A LOS BOTONES
botonesNumeros.forEach(boton=> {
    boton.addEventListener('click', ()=> 
        display.agregarNumero(boton.innerHTML));
});

botonesOperadores.forEach(boton =>{
    boton.addEventListener('click', () => display.operar(boton.value))
});