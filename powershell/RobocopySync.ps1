# Array mit Quell- und Zielordnern festlegen
$folders = @(
    @{ Source = ""; Destination = "" }
)

# Robocopy-Optionen als String definieren
$robocopyOptions = "/E /XO /XC /XN /COPYALL /MIR"

# Für jedes Quell- und Zielordner-Paar Robocopy ausführen
foreach ($folder in $folders) {
    $sourcePath = $folder["Source"]
    $destinationPath = $folder["Destination"]

    Write-Output "Synchronisiere $sourcePath nach $destinationPath..."

    try {
        Start-Process -FilePath "robocopy" -ArgumentList "$sourcePath $destinationPath $robocopyOptions" -NoNewWindow -Wait
        if ($LASTEXITCODE -le 3) {
            Write-Output "Synchronisation von $sourcePath nach $destinationPath erfolgreich abgeschlossen."
        } else {
            Write-Output "Fehler beim Kopieren von $sourcePath nach $destinationPath. Fehlercode: $LASTEXITCODE"
        }
    } catch {
        Write-Output "Ein Fehler ist bei der Synchronisation von $sourcePath nach $destinationPath aufgetreten: $_"
    }
}
