<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()>
Partial Class frmMain
	Inherits System.Windows.Forms.Form

	'Form overrides dispose to clean up the component list.
	<System.Diagnostics.DebuggerNonUserCode()>
	Protected Overrides Sub Dispose(ByVal disposing As Boolean)
		Try
			If disposing AndAlso components IsNot Nothing Then
				components.Dispose()
			End If
		Finally
			MyBase.Dispose(disposing)
		End Try
	End Sub

	'Required by the Windows Form Designer
	Private components As System.ComponentModel.IContainer

	'NOTE: The following procedure is required by the Windows Form Designer
	'It can be modified using the Windows Form Designer.  
	'Do not modify it using the code editor.
	<System.Diagnostics.DebuggerStepThrough()>
	Private Sub InitializeComponent()
		Me.btnSave = New System.Windows.Forms.Button()
		Me.btnLoad = New System.Windows.Forms.Button()
		Me.txtRank = New System.Windows.Forms.TextBox()
		Me.txtLevel = New System.Windows.Forms.TextBox()
		Me.SuspendLayout()
		'
		'btnSave
		'
		Me.btnSave.Location = New System.Drawing.Point(170, 50)
		Me.btnSave.Name = "btnSave"
		Me.btnSave.Size = New System.Drawing.Size(100, 23)
		Me.btnSave.TabIndex = 1
		Me.btnSave.Text = "Save"
		Me.btnSave.UseVisualStyleBackColor = True
		'
		'btnLoad
		'
		Me.btnLoad.Location = New System.Drawing.Point(170, 21)
		Me.btnLoad.Name = "btnLoad"
		Me.btnLoad.Size = New System.Drawing.Size(100, 23)
		Me.btnLoad.TabIndex = 2
		Me.btnLoad.Text = "Load"
		Me.btnLoad.UseVisualStyleBackColor = True
		'
		'txtRank
		'
		Me.txtRank.Location = New System.Drawing.Point(170, 80)
		Me.txtRank.Name = "txtRank"
		Me.txtRank.Size = New System.Drawing.Size(100, 20)
		Me.txtRank.TabIndex = 3
		Me.txtRank.Text = "Rank"
		Me.txtRank.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
		'
		'txtLevel
		'
		Me.txtLevel.Location = New System.Drawing.Point(170, 107)
		Me.txtLevel.Name = "txtLevel"
		Me.txtLevel.Size = New System.Drawing.Size(100, 20)
		Me.txtLevel.TabIndex = 4
		Me.txtLevel.Text = "Level"
		Me.txtLevel.TextAlign = System.Windows.Forms.HorizontalAlignment.Center
		'
		'frmMain
		'
		Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
		Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
		Me.ClientSize = New System.Drawing.Size(441, 228)
		Me.Controls.Add(Me.txtLevel)
		Me.Controls.Add(Me.txtRank)
		Me.Controls.Add(Me.btnLoad)
		Me.Controls.Add(Me.btnSave)
		Me.Name = "frmMain"
		Me.Text = "Chill's"
		Me.ResumeLayout(False)
		Me.PerformLayout()

	End Sub
	Friend WithEvents btnSave As Button
	Friend WithEvents btnLoad As Button
	Friend WithEvents txtRank As TextBox
	Friend WithEvents txtLevel As TextBox
End Class
