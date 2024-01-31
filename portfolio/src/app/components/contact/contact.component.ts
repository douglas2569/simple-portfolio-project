import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { environment } from 'src/environments/environment';
import SendEmail from '../../models/SendEmail';
import { SendEmailService } from 'src/app/services/sendemail.service';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {
  to!:string
  emailForm!:FormGroup

  constructor(private sendEmailService:SendEmailService) { }

  ngOnInit(): void {
    this.emailForm = new FormGroup({
      subject: new FormControl('',Validators.required),
      message: new FormControl('',Validators.required),
    })

    this.to = environment.userEmail

  }


  get subject(){
    return this.emailForm.get('subject')!
  }

  get message(){
    return this.emailForm.get('message')!
  }

  submit():void{
    if(this.emailForm.invalid) return

    const data:SendEmail = {
      to:this.to,
      subject:this.subject.value,
      message:this.message.value
    }

    this.sendEmailService.send(data).subscribe((response)=>{
      console.log(response.data)
    })
  }

}
