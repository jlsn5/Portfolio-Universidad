//JOSE LUIS SEGURA NAVARRO - 23902549Y

abstract interface Converso{

    //Pueden ser de dos tipos: PRECURSOR y EMPRENDEDOR

    //Metodos
    public abstract void contratado(Neutral neu);

    public abstract void despedido();

    public abstract boolean entra(Neutral neu);

    public abstract Ubicacion sale(Neutral neu);

    public abstract void comunicado(Converso conv);

    public abstract boolean estaDentro();

    public abstract void guasap(Neutral neu);

    public abstract void winner(double dou);

    public abstract Neutral getTrabajo();

    public abstract Neutral getOficina();

    public abstract void sumaDinero(double dou);
    
}
