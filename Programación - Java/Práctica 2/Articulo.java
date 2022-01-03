//JOSE LUIS SEGURA NAVARRO - 23902549Y
public class Articulo{

    //Atributos
    private String nombre;
    private int valor;

    //Metodos
    //Constructor
    public Articulo(String nom){
        if(nom != null){
            nombre = nom;
        }else{
            nombre = "alimento";
        }
        valor = 0;
    }

    //constructor extra
    public Articulo(String nom, int val){
        if(nom != null){
            nombre = nom;
        }else{
            nombre = "alimento";
        }
        valor = val;
    }

    public void actualizaValor(String cad){
        if(cad == null){
            cad = "";
        }
        //Ponerlo en valor absoluto
        valor = Math.abs(nombre.compareTo(cad));
    }

    public String toString(){
        String dev = nombre+" "+valor+"\n";
        return dev;
    }

    public String getNombre(){
        return nombre;
    }

    public int getValor(){
        return valor;
    }
    
    //Extra
    public void setValor(int num){
        int dev = num;
        valor = dev;
    }

}