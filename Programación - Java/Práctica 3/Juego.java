import java.io.*;

//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class Juego {
    public static void main(String[] args){

        if(args != null){
            
            FileReader cin = null;
            BufferedReader mibuf = null;
            
            try{
                cin = new FileReader(args[0]);
                mibuf = new BufferedReader(cin);

                String cadena = mibuf.readLine();

                String[]aux = cadena.split(" ");
                
                int a1 = Integer.parseInt(aux[0]);
                int a2 = Integer.parseInt(aux[1]);
                int a3 = Integer.parseInt(aux[2]);

                Consecutivas conse = new Consecutivas(a1,a2,a3,aux[3],aux[4]);

                //LOOP
                while(cadena != null){
                    try{
                        cadena = mibuf.readLine();
                        String[] aux2 = cadena.split(" ");
                        Ficha fi = new Ficha(aux2[0]);

                        boolean coloca = conse.colocaFicha(fi,Integer.parseInt(aux2[1]));
                        
                        if(coloca) == true){
                            System.out.println(aux2[0]+"-"+fi.getFila()+","+Integer.parseInt(aux2[1]));
                        }else{
                            System.out.println(fi.getColor());
                        }

                    }catch(DatoNoValido e){
                        System.out.println(e);
                    }catch(UbicacionNoValida u){
                        System.out.println(u);
                    }
                }

            }catch(IOException e){
                System.err.println(e);
            }catch(WinWin w){
                System.out.println(w);
            }
            finally{
                if(mibuf != null){
                    try{
                        mibuf.close();
                    }catch(IOException e){
                        e.printStackTrace();
                    }
                }
                if(cin != null){
                    try{
                        cin.close();
                    }catch(IOException e){
                        e.printStackTrace();
                    }
                }
            }
        }else{
            System.out.println("Forma de uso: java Juego ficEntrada");
        }            
        
    }
    
}
