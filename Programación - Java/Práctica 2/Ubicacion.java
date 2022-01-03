//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class Ubicacion {

    //Atributos
    private int grada;      //fila de localidad
    private int asiento;    //columna dentro de fila
    
    //Metodos
    public Ubicacion(int grad, int asie){
        grada = grad;
        asiento = asie;
    }

    public int getGrada(){
        return grada;
    }

    public int getAsiento(){
        return asiento;
    }

}