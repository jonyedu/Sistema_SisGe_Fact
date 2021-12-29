<style>
    body {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* da el tamaño a toda la tabla y quita los espacios entre las celdas */
    .piePaginaStyle {
        /* width: 100%; */
        border-collapse: collapse;
    }

    /* Da el tamaño de la letra a la 2da parte cabecera */
    .sizeFontPiePagina {
        font-size: 11px;
    }

    .sizeFontPiePaginaValor {
        font-size: 9px;
        font-weight: normal;
    }
</style>



<!-- Pie de Pagina  -->
<table class="tableStyleAll ">
    <tr>
        <!-- <th>
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th class="sizeFontPiePagina">Información Adicional</th>
                </tr>
                <tr>
                    
                </tr>
            </table>
        </th> -->
        <th>
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                   
                </tr>
             
            </table>
        </th>
        <th style="width: 38%;">
            <table class="border" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th style="font-size: 10px;text-align: left;" class="sizeFontPiePaginaValor" style="align-items: left;"></th>
                    <th style="font-size: 10px;text-align: right;" class="sizeFontPiePaginaValor"> <B> Total de Ventas:</B> ${{  $total }}</th>
                </tr>
                 
            </table>
        </th>
    </tr>
    

</table>
<!-- Fecha de Impresión: {{ date('Y-m-d H:i:s') }} -->