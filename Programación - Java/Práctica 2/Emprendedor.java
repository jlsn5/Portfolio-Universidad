//JOSE LUIS SEGURA NAVARRO - 23902549Y

import java.util.ArrayList;

public class Emprendedor extends Radical implements Converso{

    //Atributos
    private Articulo[] existencias;
    private Neutral oficina;
    private Neutral trabajo;
    private double dinero;
    //Aux
    private ArrayList<Radical> comprobar;

    //Metodos
    //Constructor
    public Emprendedor(double pes,double fuerz ,String nom,int tam){
        super(pes,fuerz,nom);
        if(tam < 0){
            existencias = new Articulo[0];
        }else{
            existencias = new Articulo[tam];
        }
        oficina = null;
        trabajo = null;
        dinero = 125.5;
        comprobar = new ArrayList<Radical>();
    }

    public void contratado(Neutral neu){
        trabajo = neu;
    }

    public void despedido(){
        trabajo = null;
    }

    public boolean entra(Neutral neu){
        boolean dev = false;
        double coste = 0;
        Ubicacion ubi = neu.busquedaDerecha();
        if(ubi != null){
            coste = neu.ventaDeEntrada(this, ubi, dinero);

            if(coste != -1){
                //Restar dinero
                dinero = coste;
                //dinero = dinero - coste;
                dev = true;
            }
        }

        return dev;
    }

    public Ubicacion sale(Neutral neu){
        Ubicacion dev = null;
        if(neu.localizacion(this) == oficina.localizacion(this)){
            dev = neu.localizacion(this);
            oficina = null;
        }

        return dev;
    }

    public void comunicado(Converso conv){
            conv.guasap(trabajo);
    }

    public void guasap(Neutral neu){
        oficina = neu;
    }

    public boolean estaDentro(){
        boolean dev = false;
        if(oficina != null){
            dev = true;
        }

        return dev;
    }

    public void winner(double d){
        dinero = dinero + d;
    }

    public Neutral getTrabajo(){
        return trabajo;
    }

    public void genera(String nom){
        Articulo art = new Articulo(nom);
        boolean band = false;
        //Buscar espacio libre de existencias
        for (int i = 0; i < existencias.length; i++) {
            if(existencias[i] == null){
                if(i != 0 && existencias[i-1] != null){
                    art.actualizaValor(existencias[i-1].getNombre());
                }else{
                    art.actualizaValor("");
                }
                existencias[i] = art;
                band = true;
            }
        }
        if(band == false){
            //Redimensionar existencias y meter articulo
            Articulo[] ex1 = existencias;
            Articulo[] exs = new Articulo[existencias.length+1];

            for (int i = 0; i < existencias.length; i++) {
                exs[i] = ex1[i];
            }
            existencias = exs;

            if(existencias.length == 2){   
                art.actualizaValor(existencias[existencias.length-2].getNombre());
                existencias[existencias.length-1] = art;
            }else{
                if(existencias.length > 2 && existencias[existencias.length-2] != null){
                    art.actualizaValor(existencias[existencias.length-2].getNombre());
                    //art.setValor(11);
                    existencias[existencias.length-1] = art;
                }else{
                    art.actualizaValor("");
                    //art.setValor(22);
                    existencias[existencias.length-1] = art;
                }
            }
        }
    }

    public void comprado(Articulo art,double dou){
        dinero = dinero + dou;

        //Quitar articulo de exsitencias
        if(art != null){
            for (int i = 0; i < existencias.length; i++) {
                if(art == existencias[i]){
                    existencias[i] = null;
                }
            }
        }
    }

    public Articulo ataca(Fundador fund){
        Articulo aux = null;

        return aux;
    }
    public Radical invita(Radical rad,String s){
        Radical nuevorad = null;
        boolean invitado = false;

        //Comprobar si esta el radical
        for (int i = 0; i < comprobar.size(); i++) {
            if(comprobar.get(i) == rad){
                invitado = true;
            }
        }

        double binario = 0;
        int numero = (int) this.getPeso();
        int digito;
        int exp = 0;
        int aux1=0;
        String binString;

        if(invitado == false){
            if(rad instanceof Emprendedor){
                if(this.getSexo() == 'V'){
                    if(rad.getSexo() == 'M'){
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
                        if(loco < rad.getPeso()){
                            //Se acepta la invitacion
                            nuevorad = new Emprendedor(loco , rad.getFuerza(), s, existencias.length);

                            String pesonuevo = String.valueOf(this.getPeso());
                            double pon = this.getFuerza() + pesonuevo.charAt(0)-'0';

                            this.setFuerza(pon);
                            double poner = this.getPeso() - (this.getPeso()*0.40);
                            this.setPeso(poner);
                        }
                        //Variable privada para comprobar si ya ha sido invitado
                        comprobar.add(rad);
                    }
                } 
            }else{
                //Si recibe de Radical normal no emprendedor
                nuevorad = super.invita(rad,s);
                comprobar.add(rad);
            }
        }
        return nuevorad;
    }

    public Neutral getOficina(){
        return oficina;
    }

    public ArrayList<Articulo>  getExistencias(){
        ArrayList<Articulo> dev = new ArrayList<Articulo>();
        for (int i = 0; i < existencias.length; i++) {
            dev.add(existencias[i]);
        }
        return dev;
    }

    public void setExistencias(Articulo[] arts){
        existencias = arts;
    }

    public double getDinero(){
        return dinero;
    }
    public void sumaDinero(double aux){
        dinero = dinero +aux;
    }
    
}
