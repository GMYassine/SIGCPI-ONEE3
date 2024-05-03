<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f9f9f9">
    <tr>
        <td align="center" style="padding: 40px 0;">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <tr>
                    <td align="center" style="padding: 40px;">
                        <h1 style="margin: 0; color: #333333; font-size: 24px; font-family: sans-serif;">La maintenance de <span style="color: blue;">{{ $data["materialDesignation"] }}</span> est terminée</h1>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 0 40px;">
                        <p style="margin: 20px 0; font-size: 18px; color: #666666; font-family: sans-serif;">Cher {{ $data["agentFullName"] }},</p>
                        <p style="margin: 20px 0; font-size: 18px; color: #666666; font-family: sans-serif;">Cet e-mail est pour confirmer que la maintenance de matérial <span style="color: blue;">{{ $data["materialDesignation"] }}</span> est terminée.</p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 40px;">
                        <p style="margin: 0; font-size: 18px; color: #666666; font-family: sans-serif;">Meilleures Salutations,</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>