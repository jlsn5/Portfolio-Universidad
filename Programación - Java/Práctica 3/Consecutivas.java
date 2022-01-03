//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class Consecutivas {
    //Atributos
    private Ficha[][] tablero;
    private int nconsecutivas;
    private String[] colores;

    //Metodos
    //Constructor
    public Consecutivas(int fil, int col, int conse, String color1, String color2) throws DatoNoValido{
        //Comprobar parametros
        tablero = null;
        colores = new String[2];

        if(fil>0 && col>0 && conse>2 && conse <= fil && conse <=col && color1 != null && color1.equals("") == false && color2 != null && color2.equals("") == false){
            tablero = new Ficha[fil][col];
            nconsecutivas = conse;
            if(color1.equals(color2) || color2.equals(color1)){
                throw new DatoNoValido("color no valido");
            }else{
                colores[0] = color1;
                colores[1] = color2;
            }
        }else{
            //Filtrar donde es el error
            if(fil <= 0){
                throw new DatoNoValido(fil);
            }
            if(col <= 0){
                throw new DatoNoValido(col);
            }
            if(conse <= 2 || conse > fil || conse > col){
                throw new DatoNoValido(conse);
            }
            if(color1 == null || color1.equals("")){
                throw new DatoNoValido("color no valido");
            }
            if(color2 == null || color2.equals("")){
                throw new DatoNoValido("color no valido");
            }
        }
        //tablero = null;

    }

    public boolean colocaFicha(Ficha fi, int columna) throws DatoNoValido, UbicacionNoValida, WinWin{
        boolean dev = false;
        boolean band = false;
        boolean colocada = false;
        int filextra = 0;

        if(fi != null){

            //buscar fila donde colocar
            for (int i = tablero.length-1; i > 0 && band == false; i--) {
                    if(tablero[i][columna] == null){
                        band = true;
                        filextra = i;
                    }
            }

            //1. Filtrar color
            if(fi.getColor().equals(colores[0]) || fi.getColor().equals(colores[1])){

                //2. Filtra que no este ya colocada
                for (int i = 0; i < tablero.length; i++) {
                    for (int j = 0; j < tablero[0].length; j++) {
                        if(tablero[i][j] == fi){
                            colocada = true;
                        }
                    }
                }
                //if(fi.getColumna() == -1){
                if(colocada == false){

                    //3. Filtra que la columna este dentro de rango
                    if(columna < 0 || columna > tablero[0].length){
                        throw new UbicacionNoValida(columna);

                    }else{
                        Ubicacion uaux = new Ubicacion(filextra,columna);

                        if(tablero[filextra][columna] == null){
                            tablero[filextra][columna] = fi;
                            fi.colocaFicha(uaux);
                            dev = true;
                        }

                        //Comprobar si se ha ganado la partida
                        int naux = 0;
                        int nauxvertical = 0;
                        int nauxdiag = 0;
                        int nauxdiagsup = 0;
                        int nauxdiaginf = 0;

                        /* ------- HORIZONTAL ------- */        
                        for (int j = 0; j < tablero[0].length; j++) {
                            if(tablero[filextra][j] != null){
                                if(tablero[filextra][j].getColor().equals(fi.getColor()) && naux <= nconsecutivas){
                                    naux++;
                                }else{
                                    naux = 0;
                                }
                            }else{
                                naux = 0;
                            }
                        }
                        //Comprobacion
                        if(naux >= nconsecutivas){
                            throw new WinWin(fi);
                        }

                        /* ------- VERTICAL ------- */
                        for (int i = 0; i < tablero.length; i++) {
                            if(tablero[i][columna] != null){
                                if(tablero[i][columna].getColor().equals(fi.getColor()) && nauxvertical <= nconsecutivas){
                                    nauxvertical++;
                                }else{
                                    nauxvertical = 0;
                                }
                            }else{
                                nauxvertical = 0;
                            }
                        }
                        //Comprobacion
                        if(nauxvertical >= nconsecutivas){
                            throw new WinWin(fi);
                        }

                        /* ------- Diagonal Principal hacia la derecha------- */
                        for (int i = 0; i < tablero.length; i++) {
                            for (int j = 0; j < tablero[0].length; j++) {
                                if(i == j){
                                    if(tablero[i][j] != null){
                                        if(tablero[i][j].getColor().equals(fi.getColor()) && nauxdiag <= nconsecutivas){
                                            nauxdiag++;
                                        }else{
                                            nauxdiag = 0;
                                        }
                                    }else if(nauxdiag < nconsecutivas){
                                        nauxdiag = 0;
                                    }
                                }
                            }
                        }
                        //System.out.println("Diagonal principal color "+fi.getColor()+" "+nauxdiag);
                        //Comprobacion
                        if(nauxdiag>= nconsecutivas){
                            throw new WinWin(fi);
                        }
                        int cont=1;
                        /* ------- Diagonal Superior hacia la derecha------- */
                        for (int i = 0; i < tablero.length; i++) {
                            for (int j = 0; j < tablero[0].length; j++) {
                                if(i+cont == j){
                                    if(tablero[i][j] != null){
                                        if(tablero[i][j].getColor().equals(fi.getColor()) && nauxdiagsup <= nconsecutivas){
                                            nauxdiagsup++;
                                        }else{
                                            nauxdiagsup = 0;
                                        }
                                    }else if(nauxdiagsup < nconsecutivas){
                                        nauxdiagsup = 0;
                                    }
                                }
                            }
                        }
                        cont++;
                        //System.out.println("Diagonal SUP color "+fi.getColor()+" "+nauxdiagsup);
                        //Comprobacion
                        if(nauxdiagsup>= nconsecutivas){
                            throw new WinWin(fi);
                        }

                        int cont2=1;
                        /* ------- Diagonal inferior hacia la derecha------- */
                        for (int i = 0; i < tablero.length; i++) {
                            for (int j = 0; j < tablero[0].length; j++) {
                                if(i-cont2 == j){
                                    if(tablero[i][j] != null){
                                        if(tablero[i][j].getColor().equals(fi.getColor()) && nauxdiaginf <= nconsecutivas){
                                            nauxdiaginf++;
                                        }else{
                                            nauxdiaginf = 0;
                                        }
                                    }else if(nauxdiaginf < nconsecutivas){
                                        nauxdiaginf = 0;
                                    }
                                }
                            }
                        }
                        cont2++;
                        //Comprobacion
                        if(nauxdiaginf>= nconsecutivas){
                            throw new WinWin(fi);
                        }

                    }
                }
            }else{
                throw new DatoNoValido(fi.getColor(), colores);
            }



        }
        return dev;
    }

    public void iniciaTablero(){
        for (int i = 0; i < tablero.length; i++) {
            for (int j = 0; j < tablero[0].length; j++) {
                if(tablero[i][j] != null){
                    tablero[i][j].resetea();
                    tablero[i][j] = null;
                }
                //tablero[i][j] = null;
            }
        }
    }

    //TERMINAR
    public void muestraTablero(){
        for (int i = 0; i < tablero.length; i++) {
            for (int j = 0; j < tablero[0].length; j++) {
                if(tablero[i][j] != null){
                    System.out.print(tablero[i][j].getColor().charAt(0));
                }else{
                    System.out.print('X');
                }
                if(j == tablero[0].length-1){
                    System.out.print("\n");
                }
            }
        }
        
    }

    public String getColor1(){
        return colores[0];
    }

    public String getColor2(){
        return colores[1];
    }

    public int getFilas(){
        return tablero.length;
    }

    public int getColumnas(){
        return 4;
    }

    public int getNumero(){
        return nconsecutivas;
    }
}
