//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class Ficha {

    //Atributos
    private String color;
    private Ubicacion casilla;

    //Metodos
    //Constructor
    public Ficha(String colo) throws DatoNoValido{
        if(colo == null || colo.equals("")){
            throw new DatoNoValido("ficha sin color");
        }else{
            color = colo;
        }
        casilla = null;
    }

    public boolean colocaFicha(Ubicacion ubi){
        boolean dev = false;
        if(ubi != null){
            if(casilla == null){
                casilla = ubi;
                dev = true;
            }
        }
        return dev;
    }

    public int getFila(){
        int dev = -1;

        if(casilla != null){
            dev = casilla.getFila();
        }
        return dev;
    }

    public int getColumna(){
        int dev = -1;

        if(casilla != null){
            dev = casilla.getColumna();
        }
        return dev;
    }

    public String getColor(){
        return color;
    }

    public void resetea(){
        casilla = null;
    }

    //Extra
    public Ubicacion getCasilla(){
        return casilla;
    }
    
}
