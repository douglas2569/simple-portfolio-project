import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {  
  @Input()
  to!:string
  @Input()
  message:string = "Olá Douglas, "

  constructor() { }

  ngOnInit(): void {}

  sendEmail():void{    
    console.log(`${this.message} | ${this.to} `)
  }

}
