<?php 

ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);

abstract class Persona {

    protected $dni;
    protected $nombre;
    protected $correo;
    protected $celular;

    public function __get($propiedad){
        return $this->$propiedad;
    }
    public function __set($propiedad,$valor){
        $this->$propiedad = $valor;
    }
   abstract public function imprimir();

}
class Cliente extends Persona {
    private $aTarjetas;
    private $bActivo;
    private $fechaAlta;
    private $fechaBaja;

    public function __construct(){
        $this->aTarjetas = array();
        $this->bActivo = true;
        $this->fechaAlta = date("d/m/Y");
    }
    public function __get($propiedad){
        return $this->$propiedad;
    }
    public function __set($propiedad,$valor){
        $this->$propiedad = $valor;
    }
public function agregarTarjeta($tarjeta){
        $this->aTarjetas[] = $tarjeta; 

}
public function darDeBaja($fecha){
    $this->fechaBaja = $fecha;
    $this->bActivo = false; //Baja logica 
}
public function imprimir(){
    {
        echo "<div class='card'>";
        echo "<div class='card-header'>Cliente: {$this->nombre}</div>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>DNI: {$this->dni}</h5>";
        echo "<p class='card-text'>Correo: {$this->correo}</p>";
        echo "<p class='card-text'>Celular: {$this->celular}</p>";
        echo "<p class='card-text'>Fecha de alta: {$this->fechaAlta}</p>";
        if ($this->fechaBaja) {
            echo "<p class='card-text'>Fecha de baja: {$this->fechaBaja}</p>";
        }
        echo "<h5 class='card-title'>Tarjetas:</h5>";
        foreach ($this->aTarjetas as $tarjeta) {
            echo "<p class='card-text'>Número: {$tarjeta->numero} - Tipo: {$tarjeta->tipo} - Vencimiento: {$tarjeta->fechaVto}</p>";
        }
        echo "</div>";
        echo "</div>";
    }
    }
}

class Tarjeta {
    private $numero;
    private $fechaEmision;
    private $fechaVto;
    private $tipo;
    private $cvv;

    const VISA = "VISA";
    const MASTERCARD = "Mastercard";
    const AMEX = "American Express";


    public function __construct($numero,$fechaVto,$fechaEmision,$tipo,$cvv)
    {
        
        $this->numero = $numero;
        $this->fechaVto = $fechaVto;
        $this->fechaEmision = $fechaEmision;
        $this->tipo = $tipo;
        $this->cvv = $cvv;
    }
    public function __get($propiedad){
        return $this->$propiedad;
    }
    public function __set($propiedad,$valor){
        $this->$propiedad = $valor;
    }
}

$cliente1 = new Cliente();
$cliente1->dni = "35123789";
$cliente1->nombre = "Ana Valle";
$cliente1->correo = "ana@correo.com";
$cliente1->celular = "1156781234";
$tarjeta1 = new Tarjeta(Tarjeta::VISA, "4223750778806383", "06/2020", "01/2023", "275");
$tarjeta2 = new Tarjeta(Tarjeta::AMEX, "347572886751981", "01/2022", "07/2027", "136");
$tarjeta3 = new Tarjeta(Tarjeta::MASTERCARD, "5415620495970009", "07/2021", "12/2024", "742");
$cliente1->agregarTarjeta($tarjeta1);
$cliente1->agregarTarjeta($tarjeta2);
$cliente1->agregarTarjeta($tarjeta3);

$cliente2 = new Cliente();
$cliente2->dni = "48456876";
$cliente2->nombre = "Bernabe Paz";
$cliente2->correo = "bernabe@correo.com";
$cliente2->celular = "1145326787";
$cliente2->agregarTarjeta(new Tarjeta(Tarjeta::VISA, "4969508071710316", "06/2021", "08/2025", "865"));
$cliente2->agregarTarjeta(new Tarjeta(Tarjeta::MASTERCARD, "5149107669552238", "03/2022", "04/2025", "554"));
$cliente2->darDeBaja(Date("23/08/2023"));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Socio no se meta en mi negocio</title>
</head>
<body>
    <main class="container">
        <div class="row text-center py-4">
            <h1>Socio no se meta en mi negocio</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <?php $cliente1->imprimir(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php $cliente2->imprimir(); ?>
            </div>
        </div>

    </main>
    
</body>
</html>