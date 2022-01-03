//JOSE LUIS SEGURA NAVARRO - 23902549Y

public class WinWin extends Exception{
    public WinWin(Ficha fi){
        super(fi.getColor() + "("+fi.getFila() + "," + fi.getColumna() + ")");
    }

    public String getMessage(Ficha fi){
        String dev = fi.getColor() + "("+fi.getFila() + "," + fi.getColumna() + ")";
        return dev;
    }
}
