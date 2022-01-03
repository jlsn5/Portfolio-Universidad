import java.util.ArrayList;

//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class Neutral {
    
    //Atributos
    private String nombre;
    private Converso[][] gradas;
    private double caja;
    private Converso conserje;

    //Metodos
    public Neutral(int filas, int columnas, double caj, String cad){
        if(filas > 0){
            if(columnas> 0){
                gradas = new Converso[filas][columnas];
            }else{
                gradas = new Converso[filas][2];
            }
        }else{
            if(columnas> 0){
                gradas = new Converso[2][columnas];
            }else{
                gradas = new Converso[2][2];
            }
        }

        if(caj > 300){
            caja = 300.0;
        }else{
            caja = caj;
        }

        //Asignar nombre
        if(cad != null){
            nombre = cad;
        }else{
            nombre = "Aoyama";
        }

        conserje = null;    //No hay conserje
    }

    public boolean contrata(Converso conv){
        boolean dev = false;
        boolean band = false;
        //Cumplir 3 condiciones para ser conserje
        
        if(conv instanceof Precursor){
            Precursor aux = (Precursor) conv;
            if(aux.esSanador() == true){
                band = true;
            }
        }
        
        if(conserje == null && conv.getTrabajo() == null && band == false){   //faltan mas
            conserje = conv;
            conv.contratado(this);
            dev = true;
        }
        return dev;
    }

    public void despide(){
        //conserje = null;
        conserje.despedido();
        conserje = null;
    }

    public Ubicacion busquedaIzquierda(){
        Ubicacion ubi = null;
        int centro = (gradas[0].length)/2 + (gradas[0].length)%2;
        boolean band = false;

        //Recorrer gradas mitad izquierda
        for (int i = 0; i < gradas.length && band == false; i++) {
            for (int j = 0; j <= centro && band == false; j++) {
                //Buscar localidad disponible
                if(gradas[i][j] == null){
                    ubi = new Ubicacion(i,j);
                    band = true;
                }
            }
        }
        return ubi;
    }

    public Ubicacion busquedaDerecha(){
        Ubicacion ubi = null;
        int centro = (gradas[0].length)/2 + (gradas[0].length)%2;
        boolean band = false;

        //Recorrer gradas mitad izquierda
        for (int i = 0; i < gradas.length && band == false; i++) {
            for (int j = centro; j < gradas[0].length && band == false; j++) {
                //Buscar localidad disponible
                if(gradas[i][j] == null){
                    ubi = new Ubicacion(i,j);
                }
            }
        }
        return ubi;
    }

    public double ventaDeEntrada(Converso conv, Ubicacion ubi, double importe){
        double dev = -1;
        //Comprobar si hay conserje
        if(ubi != null){
            if(conserje != null){
                if(conv.getOficina() == null){
                    double cost = ubi.getGrada() * ubi.getAsiento();
                    double coste = cost/(ocupantes()+1);

                    //1. Localidad tiene que ser libre
                    //2. Conv no puede estar en otro neutral
                    //3. Importe mayor o igual que coste entrada
                    //4. Neutral debe poder pagar al conserje antes de cobrar
                    if(gradas[ubi.getGrada()][ubi.getAsiento()] == null){
                        if(conv.estaDentro() == false){
                            if(importe >= coste){
                                if(caja >= 0.5){
                                    dev = importe - coste;
                                    caja = caja + coste;

                                    //Comunicado al conserje
                                    conserje.comunicado(conv);
                                    caja = caja - 0.5;
                                    //conserje.sumaDinero(0.5);
                                    this.getConserje().sumaDinero(0.5);
                                    gradas[ubi.getGrada()][ubi.getAsiento()] = conv;
                                }
                            }
                        }
                    }
                }    
            }
        }
        return dev;
    }

    public Ubicacion sale(Converso conv){
        Ubicacion dev = null;
        if(conserje != null && conv.estaDentro() == true){
            conserje.comunicado(conv);
            caja = caja - 0.5;
            this.getConserje().sumaDinero(0.5);
            dev = conv.sale(this);
            gradas[dev.getGrada()][dev.getAsiento()] = null;
        }

        return dev;
    }

    public Ubicacion localizacion(Converso conv){
        Ubicacion dev = null;

        if(conv != null){
            if(conv.estaDentro() == true){
                for (int i = 0; i < gradas.length; i++) {
                    for (int j = 0; j < gradas[0].length; j++) {
                        if(gradas[i][j] != null){
                            if(gradas[i][j].equals(conv)){
                                dev = new Ubicacion(i,j);
                            }
                        }
                    }
                }
            }
        }

        return dev;
    }

    public int loteria(){
        int dev = 0;
        double premio = 0;
        ArrayList<Precursor> precurs = new ArrayList<Precursor>();
        ArrayList<Emprendedor> emprend = new ArrayList<Emprendedor>();
        double mediaPrec = 0, totalPrec = 0;
        double mediaEmp = 0, totalEmp = 0;
        //Calcular media de fortaleza de los precursores
        //Calcular media de fuerza de emprendedores
        //Sumar y dividir entre 3 -> premio
        for (int i = 0; i < gradas.length; i++) {
            for (int j = 0; j < gradas[0].length; j++) {
                //Precursores
                if(gradas[i][j] instanceof Precursor){
                    //Precursor aux = gradas[i][j];
                    precurs.add((Precursor)gradas[i][j]);
                }else{
                    //Emprendedores
                    emprend.add((Emprendedor)gradas[i][j]);
                }
            }
        }

        //Calcular media Precursores
        for (int i = 0; i < precurs.size(); i++) {
            totalPrec = totalPrec + precurs.get(i).getFortaleza();
        }
        mediaPrec = totalPrec / precurs.size();

        //Calcular media Emprendedores
        for (int i = 0; i < emprend.size(); i++) {
            totalEmp = totalEmp + emprend.get(i).getFuerza();
        }
        mediaEmp = totalEmp / emprend.size();
        
        //Premio es sumar las medias y dividirlo entre 3
        premio = (mediaPrec + mediaEmp)/3;

        //Comprobar si hay suficiente saldo para todos
        if(caja >= (ocupantes()*premio)){
            //Repartir premio entre todos y devolver el numero de agraciados
            for (int i = 0; i < gradas.length; i++) {
                for (int j = 0; j < gradas[0].length; j++) {
                    gradas[i][j].winner(premio);
                    caja = caja-premio;
                    dev++;
                }
            }
        }else{
            //Si no hay suficiente, solo a grada 0
            if(caja >= (gradas.length*premio)){
                for (int i = 0; i < gradas[0].length; i++) {
                    gradas[0][i].winner(premio);
                    caja = caja - premio;
                    dev++;
                }
            }else{
                //No se reparte nada
                dev = 0;
            }
        }
        return dev;
    }

    public int getLibres(){
        int dev = 0;

        //Buscar localidades vacias
        for (int i = 0; i < gradas.length; i++) {
            for (int j = 0; j < gradas[0].length; j++) {
                if(gradas[i][j] == null){
                    dev++;
                }
            }
        }
        return dev;
    }

    public int getTotal(){
        int dev = gradas.length*gradas[0].length;

        return dev;
    }

    public String getNombre(){
        return nombre;
    }

    public double getCaja(){
        return caja;
    }

    public Converso getConserje(){
        return conserje;
    }

    //Extra
    public Neutral getNeutral(){
        return this;
    }

    public double ocupantes(){
        double dev = 0;
        for (int i = 0; i < gradas.length; i++) {
            for (int j = 0; j < gradas[0].length; j++) {
                if(gradas[i][j] != null){
                    dev++;
                }
            }
        }
        return dev;
    }
}
