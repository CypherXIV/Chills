Imports System.Runtime.CompilerServices
Imports Newtonsoft.Json
Public Class frmMain

	Private Sub btnLoad_Click(sender As Object, e As EventArgs) Handles btnLoad.Click
		Dim filePath As String = System.IO.Path.Combine(Application.StartupPath, "role.json")
		If System.IO.File.Exists(filePath) Then
			Dim jsonString As String = System.IO.File.ReadAllText(filePath, System.Text.Encoding.UTF8)
			Try
				Dim role As Role = JsonConvert.DeserializeObject(Of Role)(jsonString)
				txtRank.Text = role.Rank
				txtLevel.Text = role.Level.ToString()
			Catch ex As Exception
				MessageBox.Show("An error has occurred while loading the JSON string: " & ex.Message)
			End Try

			MessageBox.Show("Data loaded from file at: " & filePath)
		Else
			MessageBox.Show("File not found: " & filePath)
		End If
	End Sub

	Private Sub btnSave_Click(sender As Object, e As EventArgs) Handles btnSave.Click
		Try
			Dim role As New Role With {.Rank = txtRank.Text, .Level = CInt(txtLevel.Text)}
			Dim filePath As String = System.IO.Path.Combine(Application.StartupPath, "role.json")
			System.IO.File.WriteAllText(filePath, "role.json")
			MessageBox.Show("File Saved")
			MessageBox.Show("Data has been saved to " & filePath)
		Catch ex As Exception
			MessageBox.Show("Please enter a valid character for each text field: " & ex.Message)
		End Try


	End Sub

	Private Sub txtInput_TextChanged(sender As Object, e As EventArgs)

	End Sub

	Public Class Role
		Public Property Rank As String
		Public Property Level As Integer
	End Class

	Private Sub frmMain_Load(sender As Object, e As EventArgs) Handles MyBase.Load

	End Sub

	Private Sub txtRank_TextChanged(sender As Object, e As EventArgs) Handles txtRank.TextChanged

	End Sub

	Private Sub txtLevel_TextChanged(sender As Object, e As EventArgs) Handles txtLevel.TextChanged

	End Sub

End Class
