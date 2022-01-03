//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class DatoNoValido extends Exception{

    public DatoNoValido(String cad){
        super(cad);
    }

    public DatoNoValido(int a){
        super(String.valueOf(a));
    }
    
    public DatoNoValido(String cad, String[]colores){
        super(cad + " distinto de "+"{"+colores[0]+","+colores[1]+"}");
    }
    
}
