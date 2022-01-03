//JOSE LUIS SEGURA NAVARRO - 23902549Y
import java.util.ArrayList;

public class Radical {
    //Atributos
    private String nombre;
    private double fuerza;
    private double peso;
    private char sexo;

    //Variables de clase
    private static int varones = 0;
    private static int mujeres = 0;

    //Metodos
    //Constructor
    public Radical(double pes, double fuerz, String nom){
        if(pes < 1.0){
            peso = 1.0;
        }else{
            peso = pes;
        }

        if(fuerz < 10.0){
            fuerza = 10.0;
        }else{
            fuerza = fuerz;
        }

        if(nom == null){
            nombre = "Fearless John";
        }else{
            nombre = nom;
        }

        if(mujeres <= 2*varones){
            sexo = 'M';
            mujeres++;
        }else{
            sexo = 'V';
            varones++;
        }
    }

    public Articulo ataca(Fundador f){
        Articulo dev = null;
        if(f != null){
            double robo = f.esAtacado(this);
            //Sumar el 60% del robo a su fuerza
            fuerza = fuerza + robo*0.6;

            //Comprobar mismo sexo
            if(sexo == f.getSexo()){
                dev = f.getPropiedades()[0];
                //Actualizar peso
                peso = peso + f.getPropiedades()[0].getValor();

                //Actualizar articulos de fundador atacado
                ArrayList<Articulo> aux = new ArrayList<Articulo>();
                for (int i = 0; i < f.getPropiedades().length; i++) {
                    aux.add(f.getPropiedades()[i]);
                }
                aux.remove(0);
                f.setPropiedades(aux);
            }
        }
        return dev;
    }

    public Radical invita(Radical r, String s){
        Radical dev = null;
        double binario = 0;
        int numero = (int)peso;
        int digito;
        int exp = 0;
        int aux1=0;
        String binString;
            if(r != null){
                if(sexo == 'V'){
                    if(r.getSexo() == 'M'){
                        //Pasar a binario
                        while(numero != 0){
                            digito = numero%2;
                            binario = binario + digito * Math.pow(10, exp);
                            exp++;
                            numero = numero/2;
                        }
                        binString = Integer.toString((int)binario);

                        //Contar los 1
                        for (int i = 0; i < binString.length(); i++) {
                            if(binString.charAt(i) == '1'){
                                aux1++;
                            }
                        }
                        int loco = aux1*5;
                        if(loco < r.getPeso()){
                            //Se acepta la invitacion
                            dev = new Radical(loco , r.getFuerza(), s);

                            //AÑADIR ENTRE SUMA Y RESTA EL PRIMER DIGITO DE AUX*5
                            /*
                            String iNum = Integer.toString(loco);
                            char num1 = iNum.charAt(0);
                            int loco1 = Character.getNumericValue(num1);
                            */
                            String pesonuevo = String.valueOf(peso);

                            fuerza = fuerza + pesonuevo.charAt(0)-'0';
                            peso = peso - (peso*0.40);
                        }
                    }
                }
            }
        return dev;
    }

    //Metodo extra
    public boolean esPrimo(int num){
        boolean primo = true;
        int cont = 2;
        while((primo) && cont != num){
            if(num % cont == 0){
                primo = false;
            }
            cont++;
        }
        return primo;
    }

    public Radical meetic(Radical r, String s){
        Radical dev = null;
        int primo=0;

        //Comprobar si es varon
        if(r != null){
            if(sexo == 'M'){
                if(r.getSexo() == 'V'){
                    //System.out.println(r.getNombre());
                    dev = r.invita(this, s);
                    if(dev != null){    //Ha aceptado la invitacion

                        //Restar de su peso el mayor primo divisor de la parte entera
                        int pesoaux = (int)peso;

                        for (int i = 2; i <= pesoaux; i++) {
                            if(esPrimo(i) == true && pesoaux%i == 0){
                                primo = i;
                            }
                        }
                        //System.out.println("peso "+ pesoaux);
                        //System.out.println("primo "+ primo);
                        peso = peso - primo;
                    }
                }
            }
        }
        return dev;
    }

    public String pelea(Radical r){
        String dev=null;
        double pelea=0;
        double op1=0;
        double op2=0;
        double intermedio=0;

        op1 = (r.getPeso() + peso);
        intermedio = (Math.abs(Math.pow(r.getFuerza(), 2)-Math.pow(fuerza, 2)))+1;
        op2 = Math.sqrt(intermedio);

        pelea = (op1/op2);

        if(pelea > 1.5){
            fuerza = fuerza + (r.getFuerza()*0.1);
            r.setFuerza(r.getFuerza()- (r.getFuerza()*0.1));
            dev = nombre;
        }else{
            r.setFuerza(r.getFuerza()+ (fuerza*0.1));
            fuerza = fuerza - (fuerza*0.1);
            dev = r.getNombre();
        }

        return dev;
    }

    public String getNombre(){
        return nombre;
    }

    public double getFuerza(){
        return fuerza;
    }

    //Metodo auxiliar
    public void setFuerza(double fu){
        fuerza = fu;
    }

    public double getPeso(){
        return peso;
    }

    //Metodo auxiliar
    public void setPeso(double pes){
        peso = pes;
    }

    public char getSexo(){
        return sexo;
    }

    public String toString(){
        double peso10 = peso*10;
        int pesoint = (int)peso10;
        double pesofinal = pesoint/10.0;

        double fuerza10 = fuerza*10;
        int fuerzint = (int)fuerza10;
        double fuerzfinal = fuerzint/10.0;

        String dev = nombre+" "+sexo+" "+pesofinal+" "+fuerzfinal+"\n";

        return dev;
    }

    public static int getVarones(){
        return varones;
    }

    public static int getMujeres(){
        return mujeres;
    }
    
}
