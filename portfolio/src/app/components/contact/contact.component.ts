import { Component, Input, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {
  @Input()
  to!:string

  emailForm!:FormGroup

  constructor() { }

  ngOnInit(): void {
    this.emailForm = new FormGroup({
      subject: new FormControl('',Validators.required),
      message: new FormControl('',Validators.required),
    })
  }


  get subject(){
    return this.emailForm.get('subject')!
  }

  get message(){
    return this.emailForm.get('message')!
  }

  submit():void{
    if(this.emailForm.invalid) return

    console.log(`${this.message} | ${this.to} `)
  }

}
