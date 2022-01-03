//JOSE LUIS SEGURA NAVARRO - 23902549Y
import java.util.ArrayList;
import java.util.Collections;

public class Fundador {
    
    //Atributos
    private String nombre;
    private double fortaleza;
    private char sexo;
    private ArrayList<Articulo> propiedades;
    private double dinero;

    //Variables de clase
    private static Fundador sanador = null;
    private static int varones = 0;
    private static int mujeres = 0;

    //Metodos
    //Constructor
    public Fundador(String nom, double fort, Articulo[] prop){
        if(nom != null){
            nombre = nom;
        }
        else{
            nombre = "John Doe";
        }
        fortaleza = fort;
        dinero = 0;

        //Meter prop en arraylist propiedades
        propiedades = new ArrayList<Articulo>();
        if(prop != null){
            for (int i = 0; i < prop.length; i++) {
                if(prop[i] != null){
                    Articulo aux = new Articulo(prop[i].getNombre(),prop[i].getValor());
                    //Articulo aux = prop[i].clone();
                    propiedades.add(aux);
                }
            }
        }
        if(varones < mujeres*2){
            sexo = 'V';
            varones++;
        }
        else{
            sexo = 'M';
            mujeres++;
        }
    }

    public int actualizaValores(String cad){
        int dev = 0;
        int aux = 0;
        int aux2 = 0;
        if(cad != null){
            for (int i = 0; i < propiedades.size(); i++) {
                aux = propiedades.get(i).getValor();
                propiedades.get(i).actualizaValor(cad);
                aux2 = propiedades.get(i).getValor();

                if(aux != aux2){
                    dev++;
                }
            }
        }
        
        return dev;
    }

    public void refuerza(){
        double mediaP = 0;
        double media = 0;
        
        if(fortaleza > 0){
            if(propiedades.size() > 0){
                //calcular la media del valor a sumar
                for (int i = 0; i < propiedades.size(); i++) {
                    mediaP = mediaP + propiedades.get(i).getValor();
                }
                media = (mediaP/propiedades.size());

                //Se asigna a fortaleza
                fortaleza = fortaleza + media;
            }
        }
        else{
            //pedir ayuda sanador
            if(sanador != null && this != sanador){
                sanador.sana(dinero/2);
                dinero = dinero - (dinero/2);

                //sanador.setDinero(sanador.getDinero()+(dinero/2));

                fortaleza = fortaleza + sanador.sana(dinero/2);
            }
        }

        //Comprobar si opta a sanador
        if(sanador == null && fortaleza > 250){
            sanador = this;
        }
        
    }

    //Metodo extra moda
    public int moda(){
        ArrayList<Integer> aux = new ArrayList<Integer>();
        int moda = 0;
        int maxrepet = 0;

        for (int i = 0; i < propiedades.size(); i++) {
            aux.add(propiedades.get(i).getValor());
        }
        Collections.sort(aux);
        //Tenemos arraylist enteros ordenada
        for (int j = 0; j < aux.size(); j++) {
            int repeticiones = 0;
            for (int k = 0; k < aux.size(); k++) {
                if(aux.get(j) == aux.get(k)){
                    repeticiones++;
                }
                if(repeticiones > maxrepet){
                    moda = aux.get(k);
                    maxrepet = repeticiones;
                }
            }
        }

        return moda;
    }

    public int sana(double num){
        int dev = 0;
        int moda = 0;
        if(this == sanador){
            if(num > 0){
                dinero = dinero + num;
                //hacer la moda en metodo externo
                moda = moda();
            }
        }
        dev = varones + mujeres + moda;
        //dev = moda + numero de fundadores
        return dev;
    }

    public Articulo vende(String s){
        Articulo dev = null;

        //Buscar entre propiedades uno igual
        if(s != null){
            for (int i = 0; i < propiedades.size(); i++) {
                if(propiedades.get(i).getNombre().equalsIgnoreCase(s)){
                    dev = propiedades.get(i);
                    //Sumar su dinero
                    dinero = dinero + propiedades.get(i).getValor();
                    propiedades.remove(i);
                }
            }
        }
        return dev;
    }

    public String negocia(Fundador f){
        String dev = "no hay intercambio";
        Articulo obj1 = null;
        Articulo obj2 = null;
        ArrayList<Articulo> aux = new ArrayList<Articulo>();


        //Comprobar que son del mismo sexo
        if(f.getSexo() == sexo){
            if(propiedades != null && f.getPropiedades() != null){
                //Comprobar si tienen propiedades
                //Ultimo objeto de pasado por parametro
                obj1 = f.getPropiedades()[f.getPropiedades().length-1];
                
                //Ultimo objeto del propio fundador
                obj2 = this.getPropiedades()[propiedades.size()-1];

                //Eliminar ultimo y añadir el nuevo al pasado por parametro, length-1 para que no meta el ultimo
                for (int i = 0; i < f.getPropiedades().length-1; i++) {
                    aux.add(f.getPropiedades()[i]);
                }
                aux.add(obj2);
                f.setPropiedades(aux);
                //Añadir el nuevo objeto

                //Eliminar ultimo y añadir el nuevo al propio fundador
                propiedades.remove(propiedades.size()-1);
                propiedades.add(obj1);

                dev =obj1.getNombre() + "-" + obj2.getNombre();
            }
        }
        return dev;
    }

    public double crea(String nom){
        double dev = 0;
        double calc = 0;
        double longi = nom.length();
        if(fortaleza >= (longi/2)){
            Articulo aux = new Articulo(nom);
            propiedades.add(0, aux);

            //Restar de fortaleza 1/3 y devolver
            calc = (longi/3);
            //System.out.println(nom.length());
            dev = calc;
            fortaleza = fortaleza - calc;
        }      

        return dev;
    }

    public double esAtacado(Radical rad){
        double dev = 0;
        double op1 = 0;
        double operacion = 0;

        actualizaValores(rad.getNombre());
        
        //Hacer media de valores de articulos y sumar fortaleza
        for (int i = 0; i < propiedades.size(); i++) {
            op1 = op1 + propiedades.get(i).getValor();
        }
        operacion = (op1/propiedades.size()) + fortaleza;

        //Primer caso
        if(operacion < rad.getFuerza()){
            dev = fortaleza;
            fortaleza = 0;
            //Dejar de ser sanador???
            if(this == sanador){
                sanador = null;
            }
        }
        //Segundo caso
        if(operacion >= rad.getFuerza()){
            dev = fortaleza*(-1);
        }
        return dev;
    }

    public boolean esSanador(){
        boolean dev = false;
        if(this == sanador){
            dev = true;
        }

        return dev;
    }

    public String getNombre(){
        return nombre;
    }

    public double getFortaleza(){
        return fortaleza;
    }

    public double getDinero(){
        return dinero;
    }

    //EXTRA
    public void setDinero(double din){
        dinero = din;
    }

    public char getSexo(){
        return sexo;
    }

    public Articulo[] getPropiedades(){
        Articulo[] dev = new Articulo[propiedades.size()];
        for (int i = 0; i < propiedades.size(); i++) {
            dev[i] = propiedades.get(i);
        }
        return dev;
    }

    //Metodo auxiliar
    public void setPropiedades(ArrayList<Articulo> prop){
        propiedades = prop;
    }

    public void anadirArticulo(Articulo art){
        propiedades.add(art);
    }

    public void eliminarArticulo(int art){
        propiedades.remove(art);
    }

    public String toString(){

        double fort10 = fortaleza*10;
        int fortint = (int)fort10;
        double fortfinal = fortint/10.0;

        double din10 = dinero*10;
        int dinint = (int)din10;
        double dinfinal = dinint/10.0;

        String dev = nombre+" "+sexo+" "+fortfinal+" "+dinfinal+"\n";
        return dev;
    }

    public static int getVarones(){
        return varones;
    }

    public static int getMujeres(){
        return mujeres;
    }

}
