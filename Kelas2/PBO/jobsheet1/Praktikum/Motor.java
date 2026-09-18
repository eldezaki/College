package Praktikum;

public class Motor extends Kendaraan {
    private String jenisTransmisi;
    private int ccMesin;

    public void setJenisTransmisi(String transmisi) { this.jenisTransmisi = transmisi; }
    public void setCcMesin(int cc) { this.ccMesin = cc; }

    @Override
    public void cetakInfo() {
        System.out.print("Motor -> ");
        super.cetakInfo();
        System.out.println("Transmisi: " + jenisTransmisi + ", CC: " + ccMesin + " cc");
    }
}