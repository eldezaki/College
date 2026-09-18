package Praktikum;

public class KipasAngin {
    private String merk;
    private int kecepatan;

    public void setMerk(String merk) { this.merk = merk; }
    public void setKecepatan(int level) { this.kecepatan = level; }
    public void cetakInfo() {
        System.out.println("Kipas Angin -> Merk: " + merk + ", Kecepatan: Level " + kecepatan);
    }
}
