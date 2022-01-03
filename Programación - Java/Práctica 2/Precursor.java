//JOSE LUIS SEGURA NAVARRO - 23902549Y
import java.util.ArrayList;

public class Precursor extends Fundador implements Converso{

    //Atributos
    private Neutral oficina;    //Donde realiza negocios
    private Neutral trabajo;    //Donde trabaja de conserje

    //Metodos
    //Constructor    
    public Precursor(String s,double fort,Articulo[] prop){
        super(s, fort, prop);
        oficina = null;
        trabajo=null;
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
        Ubicacion ubi = neu.busquedaIzquierda();
        if(ubi != null){
            coste = neu.ventaDeEntrada(this, ubi, this.getDinero());
            //System.out.println("este es el coste - "+coste);
            if(coste != -1){
                //System.out.println("entro aqui precursor");
                //Restar dinero
                this.setDinero(coste);
                dev = true;
            }
        }
        return dev;
    }

    public Ubicacion sale(Neutral neu){
        Ubicacion dev = null;
        if(neu != null && this.estaDentro()==true){
            if(neu.localizacion(this).equals(oficina.localizacion(this))){
                //System.out.println("hola");
                dev = neu.localizacion(this);
                oficina = null;
            }
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
        this.setDinero(this.getDinero()+d);
    }

    public Neutral getTrabajo(){
        return trabajo;
    }

    public void calculaIntereses(){
        double desviacion = 0;
        double media = 0;
        double mediahecha = 0;
        double n = this.getPropiedades().length;
        double operacion = 0;

        for (int i = 0; i < n; i++) {
            media = media + this.getPropiedades()[i].getValor();
        }
        mediahecha = media / n;

        for (int i = 0; i < n; i++) {
            operacion = operacion + Math.pow(this.getPropiedades()[i].getValor(),2);
        }

        desviacion = Math.sqrt(((1/n)*operacion)-Math.pow(mediahecha, 2));
        this.setDinero(this.getDinero()+desviacion);
    }
    public int negocia(Emprendedor emp){
        int dev = 0;
        ArrayList<Articulo> arts = emp.getExistencias();

        //Comprobar si estan en mismo neutral  
        if(emp.getOficina().equals(oficina)){
            //Consulta articulos en pos impar
            for (int i = 0; i < arts.size(); i++) {
                if(i !=0 && i%2 != 0){
                    //Comprobar si tiene dinero suficiente, precio = 50% articulo
                    if(this.getDinero() >= (arts.get(i).getValor()/2)){
                        this.anadirArticulo(arts.get(i));
                        emp.comprado(arts.get(i) , (arts.get(i).getValor()/2));
                        dev++;
                    }
                }
            }
        }
        return dev;
    }

    public double esAtacado(Radical rad){
        double dev = 0;
        double minimo = this.getPropiedades()[0].getValor();
        for (int i = 0; i < this.getPropiedades().length; i++) {
            if(this.getPropiedades()[i].getValor() < minimo){
                minimo = this.getPropiedades()[i].getValor();
                dev = minimo * 0.5;
            }
        }
        return dev;
    }
    
    public String negocia(Fundador fund){
        String dev = "no hay intercambio";
        ArrayList<Articulo> arts1 = new ArrayList<Articulo>();
        ArrayList<Articulo> arts2 = new ArrayList<Articulo>();

        for (int i = 0; i < this.getPropiedades().length; i++) {
            arts1.add(this.getPropiedades()[i]);
        }
        for (int i = 0; i < fund.getPropiedades().length; i++) {
            arts2.add(fund.getPropiedades()[i]);
        }

        Articulo este = arts1.get(arts1.size()-1);
        Articulo parametro = arts2.get(arts2.size()-1);

        //Comprobar si es Precursor?
        if(fund instanceof Precursor){
            dev = arts2.get(arts2.size()-1).getNombre() + "-" + arts1.get(arts1.size()-1).getNombre();

            this.eliminarArticulo(arts1.size()-1);
            this.anadirArticulo(parametro);


            fund.eliminarArticulo(arts2.size()-1);
            fund.anadirArticulo(este);
            
        }else{
            
            //Comprobar que sea del mismo sexo
            if(fund.getSexo() == this.getSexo()){
                dev = arts2.get(arts2.size()-1).getNombre() + "-" + arts1.get(arts1.size()-1).getNombre();

                this.eliminarArticulo(arts1.size()-1);
                this.anadirArticulo(parametro);

                fund.eliminarArticulo(arts2.size()-1);
                fund.anadirArticulo(este);
            }
        }
        return dev;
    }

    public Neutral getOficina(){
        return oficina;
    }

    public void sumaDinero(double aux){
        this.setDinero(this.getDinero()+aux);
    }


}
